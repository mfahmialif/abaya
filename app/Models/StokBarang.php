<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokBarang extends Model
{
    use HasFactory;

    protected $table = 'stok_barang';
    protected $guarded = [];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class, 'stok_barang_id');
    }

    public function barangKeluar()
    {
        return $this->hasMany(BarangKeluar::class, 'stok_barang_id');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'stok_barang_id');
    }
}
