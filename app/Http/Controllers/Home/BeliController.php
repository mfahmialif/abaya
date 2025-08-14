<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Services\Helper;
use App\Models\Barang;
use App\Models\StokBarang;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BeliController extends Controller
{
    function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        try {
            $request->validate(
                [
                    'jml' => 'required',
                    'barang_id' => 'required'
                ]
            );

            $carbon = new Carbon();
            $tgl = $carbon->now()->format('Y-m-d');

            $jml = $request->jml;
            $barang_id = $request->barang_id;

            $stok = StokBarang::where('barang_id', $barang_id)->first();

            if ($stok) {
                $transaksi = new Transaksi();
                $transaksi->kode_transaksi = Helper::generateTransaksi();
                $transaksi->pembeli_id = auth()->user()->id;
                $transaksi->stok_barang_id = $stok->id;
                $transaksi->jumlah = $jml;
                $transaksi->tanggal = $tgl;
                $transaksi->total_harga = $jml * $stok->harga;
                $transaksi->status = 'proses';
                $transaksi->save();
            }

            return [
                'status' => true,
                'code' => 'success',
                'message' => 'Berhasil membeli, silahkan tunggu cek dari admin'
            ];
        } catch (\Throwable $th) {
            return [
                'status' => false,
                'code' => 'error',
                'message' => $th->getMessage()
            ];
        }
    }
}
