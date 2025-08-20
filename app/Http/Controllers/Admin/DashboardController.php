<?php
namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Transaksi;
use App\Models\Departemen;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $user = \Auth::user();

        $bulanSekarang = date('m');
        $tahunSekarang = date('Y');

        // Ambil data transaksi bulan ini
        $transaksi = Transaksi::whereMonth('tanggal', $bulanSekarang)
            ->whereYear('tanggal', $tahunSekarang)
            ->get();
        $jumlahPerHari = [];
        foreach ($transaksi->groupBy('tanggal')->all() as $tanggal => $transaksis) {
            $key = date('d', strtotime($tanggal));
            $jumlahPerHari[$key] = $transaksis->count();
        }
        $getJumlahHari = date('t', strtotime(date('Y-m')));

        $categories = [];
        $series = [];
        $dataTransaksi = [];
        for ($i = 1; $i <= $getJumlahHari; $i++) {
            $categories[$i] = "$bulanSekarang/$i";
            $dataTransaksi[$i] = isset($jumlahPerHari[$i]) ? $jumlahPerHari[$i] : 0;
        }

        $series[] = [
            'name' => 'Transaksi',
            'data' => $dataTransaksi,
        ];

        $totalTransaksi = $transaksi->count();
        $totalPendapatan = $transaksi->sum('total_harga');

        $totalUserTransaksi = $transaksi->groupBy('user_id')->count();

        $totalProduct = $transaksi->groupBy('stok_barang_id')->count();
        return view('admin/dashboard/index', compact(
            'user', 'categories', 'series', 'totalTransaksi', 'totalPendapatan', 'totalUserTransaksi', 'totalProduct'
        ));
    }

}
