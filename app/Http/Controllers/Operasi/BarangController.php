<?php
namespace App\Http\Controllers\Operasi;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\StokBarang;

class BarangController extends Controller
{
    public function autocomplete($kategori, $query)
    {
        return Barang::join('stok_barang', 'barang.id', '=', 'stok_barang.barang_id')
            ->where('barang.kategori', $kategori)
            ->where(function ($q) use ($query) {
                $q->orWhere('stok_barang.kode', 'LIKE', "%$query%");
                $q->orWhere('barang.nama', 'LIKE', "%$query%");
            })
            ->select('stok_barang.id', 'stok_barang.kode', 'barang.nama', 'stok_barang.ukuran', 'stok_barang.satuan', 'stok_barang.stok', 'stok_barang.harga')
            ->limit(100)
            ->get()
            ->map(function ($barang) {
                return [
                    'label' => $barang->kode . ' - ' . $barang->nama . ' (' . $barang->ukuran . ' ' . $barang->satuan . ')',
                    'value' => $barang->kode,
                ];
            });
    }

    public function search($kode)
    {
        return StokBarang::where('kode', $kode)->with('barang')->first();
    }
}
