<?php
namespace App\Http\Controllers\Admin;

use App\Models\Barang;
use App\Models\StokBarang;
use Illuminate\Http\Request;
use App\Http\Services\Helper;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BarangMentahStokController extends Controller
{
    public function index()
    {
        $kategori = Helper::getEnumValues('barang', 'kategori');
        return view('admin.barang-mentah.stok.index', compact('kategori'));
    }

    public function data(Request $request)
    {
        $search = request('search.value');
        $data   = Barang::join('stok_barang', 'barang.id', '=', 'stok_barang.barang_id')
            ->where('barang.kategori', 'mentah')
            ->select('barang.*', 'stok_barang.ukuran', 'stok_barang.satuan', 'stok_barang.stok', 'stok_barang.harga', 'stok_barang.kode', 'stok_barang.foto');
        return DataTables::of($data)
            ->filter(function ($query) use ($search, $request) {
                $query->where(function ($query) use ($search) {
                    $query->orWhere('barang.nama', 'LIKE', "%$search%");
                    $query->orWhere('barang.kategori', 'LIKE', "%$search%");
                    $query->orWhere('stok_barang.kode', 'LIKE', "%$search%");
                });
            })
            ->editColumn('harga', function ($row) {
                return Helper::doubleToIdr($row->harga);
            })
            ->editColumn('foto', function ($row) {
                if ($row->foto == null) {
                    return '-';
                }

                if (! file_exists(public_path('stok-barang/' . $row->foto))) {
                    return 'File di server tidak ditemukan atau terhapus';
                }

                $foto = asset('stok-barang/' . $row->foto);
                return '<a href="' . $foto . '" data-fancybox="gallery" data-caption="' . $row->kode . '"><img src="' . $foto . '" alt="Foto" class="img-fluid"></a>';
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
                                        data-foto="' . $row->foto . '"
                                        >Upload Foto</button></li>
                                    <div class="dropdown-divider"></div>
                                <li>
                                    <form class="form-delete-record">
                                    ' . method_field('DELETE') . csrf_field() . '
                                        <input type="hidden" name="id" value="' . $row->id . '">
                                        <input type="hidden" name="name" value="' . $row->kode . '">
                                        <button type="submit" class="dropdown-item text-danger">
                                            Delete
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>';
                return $actionButtons;
            })
            ->rawColumns(['action', 'foto'])
            ->toJson();
    }

    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $rules = [
                'id'   => 'required|exists:stok_barang,id',
                'foto' => 'required|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            ];

            $request->validate($rules);

            $stokBarang = StokBarang::find($request->id);

            // upload foto di direktori public/stok-barang, jika tidak ada maka buat
            if (! file_exists(public_path('stok-barang'))) {
                mkdir(public_path('stok-barang'), 0755, true);
            }

            // hapus foto lama
            if ($stokBarang->foto) {
                unlink(public_path('stok-barang/' . $stokBarang->foto));
            }

            // upload foto dengan nama kode-uniqid-ext
            $foto     = $request->file('foto');
            $fotoName = $stokBarang->kode . '-' . uniqid() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('stok-barang'), $fotoName);
            $stokBarang->update([
                'foto' => $fotoName,
            ]);

            DB::commit();
            return [
                'status'  => true,
                'type'    => 'success',
                'message' => 'Berhasil upload foto',
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

            $stokBarang = StokBarang::findOrFail($request->id);
            if ($stokBarang->foto) {
                if (file_exists(public_path('stok-barang/' . $stokBarang->foto))) {
                    unlink(public_path('stok-barang/' . $stokBarang->foto));
                }
            }
            $stokBarang->delete();

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
