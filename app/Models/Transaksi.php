<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table   = 'transaksi';
    protected $guarded = [];

    public function pembeli()
    {
        return $this->belongsTo(User::class, 'pembeli_id');
    }

    public function stokBarang()
    {
        return $this->belongsTo(StokBarang::class, 'stok_barang_id');
    }
}
