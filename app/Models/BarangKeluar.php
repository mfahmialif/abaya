<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $table = 'barang_keluar';
    protected $guarded = [];

    public function stokBarang()
    {
        return $this->belongsTo(StokBarang::class, 'stok_barang_id');
    }
}
