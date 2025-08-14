<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Services\Helper;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ItemController extends Controller
{
    public function index()
    {
        return view('home.item.index');
    }

    public function data(Request $request)
    {
        $search = request('search.value');
        $data   = Transaksi::join('stok_barang', 'transaksi.stok_barang_id', '=', 'stok_barang.id')
            ->join('barang', 'stok_barang.barang_id', '=', 'barang.id')
            ->join('users as pembeli', 'transaksi.pembeli_id', '=', 'pembeli.id')
            ->where('pembeli.id', auth()->user()->id)
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
            ->rawColumns(['pembeli', 'barang', 'status'])
            ->toJson();
    }
}
