<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $guarded = [];

    public function stokBarang()
    {
        return $this->hasMany(StokBarang::class, 'barang_id');
    }
}
