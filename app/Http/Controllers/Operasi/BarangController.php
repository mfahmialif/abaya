<?php
namespace App\Http\Controllers\Operasi;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\StokBarang;

class BarangController extends Controller
{
    public function autocomplete($kategori, $query)
    {
        return Barang::limit(20)
            ->get()
            ->map(function ($barang) {
                return [
                    'label' => $barang->nama,
                    'value' => $barang->kode_barang,
                ];
            });
    }

    public function ukuran($kode)
    {
        return StokBarang::join('barang', 'stok_barang.barang_id', '=', 'barang.id')
            ->where('barang.kode_barang', $kode)
            ->select('stok_barang.*', 'barang.nama')
            ->get();
    }
}
