<?php
namespace App\Http\Controllers\Operasi;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\StokBarang;

class BarangController extends Controller
{
    public function autocomplete($kategori, $query)
    {
        return Barang::where('kategori', $kategori)
            ->where(function ($q) use ($query) {
                $q->where('nama', 'like', '%' . $query . '%')
                    ->orWhere('kode_barang', 'like', '%' . $query . '%');
            })
            ->limit(20)
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
        $barang     = Barang::where('kode_barang', $kode)->first();
        $stokBarang = StokBarang::join('barang', 'stok_barang.barang_id', '=', 'barang.id')
            ->where('barang.kode_barang', $kode)
            ->select('stok_barang.*', 'barang.nama')
            ->get();
        return [
            'barang'     => $barang,
            'stokBarang' => $stokBarang,
        ];
    }

    public function stokBarang($stokBarangId)
    {
        $stokBarang = StokBarang::find($stokBarangId);
        if ($stokBarang) {
            $stokBarang = $stokBarang->load('barang');
        }
        return $stokBarang;
    }
}
