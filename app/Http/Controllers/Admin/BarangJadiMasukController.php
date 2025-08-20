<?php
namespace App\Http\Controllers\Admin;

use App\Models\Barang;
use App\Models\StokBarang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use App\Http\Services\Helper;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BarangJadiMasukController extends Controller
{
    public function index()
    {
        return view('admin.barang-jadi.masuk.index');
    }

    public function data(Request $request)
    {
        $search = request('search.value');
        $data   = BarangMasuk::join('stok_barang', 'barang_masuk.stok_barang_id', '=', 'stok_barang.id')
            ->join('barang', 'stok_barang.barang_id', '=', 'barang.id')
            ->where('barang.kategori', 'jadi')
            ->when($request->tanggal_mulai && ! $request->tanggal_selesai, function ($query) use ($request) {
                $query->where('barang_masuk.tanggal', '>=', $request->tanggal_mulai);
            })
            ->when(! $request->tanggal_mulai && $request->tanggal_selesai, function ($query) use ($request) {
                $query->where('barang_masuk.tanggal', '<=', $request->tanggal_selesai);
            })
            ->when($request->tanggal_mulai && $request->tanggal_selesai, function ($query) use ($request) {
                $query->whereBetween('barang_masuk.tanggal', [$request->tanggal_mulai, $request->tanggal_selesai]);
            })
            ->select('barang_masuk.*', 'stok_barang.ukuran', 'stok_barang.satuan', 'stok_barang.stok', 'stok_barang.harga', 'barang.nama', 'barang.kategori', 'stok_barang.kode', 'barang.kode_barang');

        return DataTables::of($data)
            ->filter(function ($query) use ($search, $request) {
                $query->where(function ($query) use ($search) {
                    $query->orWhere('barang.nama', 'LIKE', "%$search%");
                    $query->orWhere('stok_barang.kode', 'LIKE', "%$search%");
                    $query->orWhere('barang_masuk.tanggal', 'LIKE', "%$search%");
                });
            })
            ->editColumn('nama', function ($row) {
                return '
                    <div class="d-flex justify-content-start align-items-center">
                        <div class="d-flex flex-column">
                            <div class="mb-0"><span class="badge bg-label-warning">' . $row->kode . '</span></div>
                            <h6 class="mb-0">' . $row->nama . '</h6>
                            <p class="mb-0">' . $row->ukuran . ' ' . $row->satuan . ' - Rp ' . Helper::doubleToIdr($row->harga) . '</p>
                        </div>
                    </div>
                ';
            })
            ->editColumn('keterangan', function ($row) {
                $keterangan = $row->keterangan;
                return '<a href="javascript:;" class="text-primary" data-bs-toggle="modal" data-bs-target="#modal_keterangan" data-keterangan="' . $keterangan . '">' . (strlen($keterangan) > 20 ? substr($keterangan, 0, 20) . '...' : $keterangan) . '</a>';
            })
            ->addColumn('action', function ($row) {
                if (Auth::user()->role->akses === 'owner') {
                    return '<span class="badge bg-label-secondary">Tidak ada aksi</span>';
                }
                $actionButtons = '
                        <div class="d-inline-block">
                            <a href="javascript:;" class="btn btn-sm btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="ti ti-dots-vertical ti-md"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end m-0">
                                <li>
                                    <button class="dropdown-item edit-record-button"
                                        data-id="' . $row->id . '"
                                        data-kode_barang="' . $row->kode_barang . '"
                                        data-kode="' . $row->kode . '"
                                        data-nama="' . $row->nama . '"
                                        data-ukuran="' . $row->ukuran . '"
                                        data-satuan="' . $row->satuan . '"
                                        data-harga="' . $row->harga . '"
                                        data-stok="' . $row->stok . '"
                                        data-jumlah="' . $row->jumlah . '"
                                        data-keterangan="' . e($row->keterangan) . '"
                                        data-tanggal="' . $row->tanggal . '"
                                        data-stok-barang-id="' . $row->stok_barang_id . '"
                                        data-kode="' . $row->kode . '"

                                        >Edit</button></li>
                                    <div class="dropdown-divider"></div>
                                <li>
                                    <form class="form-delete-record">
                                    ' . method_field('DELETE') . csrf_field() . '
                                        <input type="hidden" name="id" value="' . $row->id . '">
                                        <input type="hidden" name="name" value="' . $row->nama . '">
                                        <button type="submit" class="dropdown-item text-danger">
                                            Delete
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>';
                return $actionButtons;
            })
            ->rawColumns(['action', 'nama', 'keterangan'])
            ->toJson();
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $rules = [
                'barang_id'      => 'nullable|exists:barang,id',
                'stok_barang_id' => 'nullable|exists:stok_barang,id',
                'tanggal'        => 'required',
                'jumlah'         => 'required',
                'keterangan'     => 'nullable',
                'foto'           => 'nullable'
            ];

            if (is_null($request->barang_id)) {
                $rules = array_merge($rules, [
                    'nama' => 'required',
                ]);
            }

            if (is_null($request->stok_barang_id)) {
                $rules = array_merge($rules, [
                    'ukuran' => 'required',
                    'satuan' => 'required',
                    'harga'  => 'required',
                ]);
            }

            $request->validate($rules);

            $barang = Barang::find($request->barang_id);
            if (! $barang) {
                $barang = Barang::create([
                    'kode_barang' => Helper::generateKodeBarang('jadi'),
                    'nama'        => $request->nama,
                    'kategori'    => 'jadi',
                ]);
            }

            $stokBarang = StokBarang::find($request->stok_barang_id);
            if (! $stokBarang) {
                $stokBarang = StokBarang::create([
                    'barang_id' => $barang->id,
                    'kode'      => Helper::generateKode('jadi'),
                    'ukuran'    => $request->ukuran,
                    'satuan'    => $request->satuan,
                    'stok'      => $request->jumlah,
                    'harga'     => $request->harga,
                ]);
            }

            $barangMasuk = BarangMasuk::create([
                'stok_barang_id' => $stokBarang->id,
                'tanggal'        => $request->tanggal,
                'jumlah'         => $request->jumlah,
                'keterangan'     => $request->keterangan,
            ]);

            $stokAkhir = Helper::updateStokBarang($stokBarang->id);
            if ($stokAkhir < 0) {
                abort(400, 'Stok barang tidak mencukupi');
            }

            DB::commit();
            return [
                'status'  => true,
                'type'    => 'success',
                'message' => 'Berhasil menambahkan barang masuk',
            ];
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'status'  => false,
                'type'    => 'error',
                'message' => implode('<br><br>', array_map('implode', $e->errors())),
                'req'     => $request->all(),
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return [
                'status'  => false,
                'type'    => 'error',
                'message' => $th->getMessage(),
            ];
        }
    }

    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $rules = [
                'id'         => 'required|exists:barang_masuk,id',
                'tanggal'    => 'required',
                'jumlah'     => 'required',
                'keterangan' => 'nullable',
            ];

            $request->validate($rules);

            $barangMasuk = BarangMasuk::findOrFail($request->id);

            $barangMasuk->update([
                'tanggal'    => $request->tanggal,
                'jumlah'     => $request->jumlah,
                'keterangan' => $request->keterangan,
            ]);

            $stokAkhir = Helper::updateStokBarang($barangMasuk->stok_barang_id);
            if ($stokAkhir < 0) {
                abort(400, 'Stok barang tidak mencukupi');
            }

            DB::commit();
            return [
                'status'  => true,
                'type'    => 'success',
                'message' => 'Success',
            ];
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'status'  => false,
                'type'    => 'error',
                'message' => implode('<br><br>', array_map('implode', $e->errors())),
                'req'     => $request->all(),
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return [
                'status'  => false,
                'type'    => 'error',
                'message' => $th->getMessage(),
            ];
        }
    }

    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'id' => 'required',
            ]);

            $barangMasuk = BarangMasuk::findOrFail($request->id);
            $stokBarang  = $barangMasuk->stokBarang;

            $barangMasuk->delete();
            $stokAkhir = Helper::updateStokBarang($stokBarang->id);

            if ($stokAkhir < 0) {
                abort(400, 'Stok barang tidak mencukupi');
            }
            DB::commit();
            return [
                'status'  => true,
                'type'    => 'success',
                'message' => 'Success',
                'request' => $request->all(),
            ];
        } catch (\Throwable $th) {
            DB::rollback();
            return [
                'status'  => false,
                'type'    => 'error',
                'message' => $th->getMessage(),
                'request' => $request->all(),
            ];
        }
    }

}
