<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Helper;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class TransaksiController extends Controller
{
    public function index()
    {
        return view('admin.transaksi.index');
    }

    public function data(Request $request)
    {
        $search = request('search.value');
        $data   = Transaksi::join('stok_barang', 'transaksi.stok_barang_id', '=', 'stok_barang.id')
            ->join('barang', 'stok_barang.barang_id', '=', 'barang.id')
            ->join('users as pembeli', 'transaksi.pembeli_id', '=', 'pembeli.id')
            ->select('transaksi.*', 'barang.nama', 'stok_barang.ukuran', 'stok_barang.satuan', 'stok_barang.stok', 'stok_barang.harga', 'stok_barang.foto', 'pembeli.name', 'pembeli.email', 'pembeli.jenis_kelamin', 'pembeli.photo');
            
        return DataTables::of($data)
            ->filter(function ($query) use ($search, $request) {
                $query->where(function ($query) use ($search) {
                    $query->orWhere('transaksi.kode_transaksi', 'LIKE', "%$search%");
                    $query->orWhere('barang.nama', 'LIKE', "%$search%");
                });
            })
            ->addColumn('pembeli', function ($row) {
                $assetsPath = asset('photo') . '/';
                if ($row->photo) {
                    // Untuk photo gambar
                    $output = '<img src="' . $assetsPath . $row->photo . '" alt="Avatar" class="rounded-circle">';
                } else {
                    // Untuk photo badge dengan inisial
                    $stateNum = rand(0, 5);
                    $states   = ['success', 'danger', 'warning', 'info', 'primary', 'secondary'];
                    $state    = $states[$stateNum];

                    // Ambil inisial dari nama lengkap
                    preg_match_all('/\b\w/', $row->name, $matches);
                    $initials = isset($matches[0]) ? strtoupper($matches[0][0] . end($matches[0])) : '';

                    $output = '<span class="avatar-initial rounded-circle bg-label-' . $state . '">' . $initials . '</span>';
                }

                return '
                    <div class="d-flex justify-content-start align-items-center user-name">
                        <div class="avatar-wrapper">
                            <div class="avatar me-2">
                                ' . $output . '
                            </div>
                        </div>
                        <div class="d-flex flex-column">
                            <span class="emp_name text-truncate">' . htmlspecialchars($row->name) . '</span>
                            <small class="emp_post text-truncate text-muted">' . htmlspecialchars($row->email ?? 'Unknown') . '</small>
                        </div>
                    </div>
                ';
            })
            ->addColumn('barang', function ($row) {
                return '
                    <div>' . $row->nama . ' - ' . $row->ukuran . ' ' . $row->satuan . '</div>
                     <small class="emp_post text-truncate text-muted">Jumlah barang: ' . $row->jumlah . ' @' . Helper::doubleToIdr($row->harga) . '</small>
                ';
            })
            ->editColumn('total_harga', function ($row) {
                return Helper::doubleToIdr($row->total_harga);
            })
            ->editColumn('status', function ($row) {
                return '<span class="badge bg-label-' . ($row->status == 'proses' ? 'warning' : 'success') . '">' . $row->status . '</span>';
            })
            ->addColumn('action', function ($row) {
                $actionButtons = '
                        <div class="d-inline-block">
                            <a href="javascript:;" class="btn btn-sm btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="ti ti-dots-vertical ti-md"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end m-0">
                                <li>
                                    <button class="dropdown-item" onclick="updateStatus(\'' . $row->kode_transaksi . '\', \'proses\')"
                                        >Update Status Proses</button>
                                </li>
                                <li>
                                    <button class="dropdown-item" onclick="updateStatus(\'' . $row->kode_transaksi . '\', \'selesai\')"
                                        >Update Status Selesai</button>
                                </li>
                                    <div class="dropdown-divider"></div>
                                <li>
                                    <form class="form-delete-record">
                                    ' . method_field('DELETE') . csrf_field() . '
                                        <input type="hidden" name="id" value="' . $row->id . '">
                                        <input type="hidden" name="name" value="' . $row->kode_transaksi . '">
                                        <button type="submit" class="dropdown-item text-danger">
                                            Delete
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>';
                return $actionButtons;
            })
            ->rawColumns(['action', 'pembeli', 'barang', 'status'])
            ->toJson();
    }

    public function updateStatus(Request $request)
    {
        try {
            DB::beginTransaction();
            $rules = [
                'kode_transaksi' => 'required|exists:transaksi,kode_transaksi',
                'status'         => 'required|in:proses,selesai',
            ];

            $request->validate($rules);

            $transaksi         = Transaksi::where('kode_transaksi', $request->kode_transaksi)->first();
            $transaksi->status = $request->status;
            $transaksi->save();

            $stokAkhir = Helper::updateStokBarang($transaksi->stok_barang_id);
            if ($stokAkhir < 0) {
                abort(400, 'Stok barang tidak mencukupi');
            }
            DB::commit();
            return [
                'status'  => true,
                'type'    => 'success',
                'message' => 'Berhasil update status transaksi',
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

            $data         = Transaksi::findOrFail($request->id);
            $stokBarangId = $data->stok_barang_id;
            $data->delete();

            $stokAkhir = Helper::updateStokBarang($stokBarangId);
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
