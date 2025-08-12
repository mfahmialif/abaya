<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi')->unique();
            $table->foreignId('pembeli_id')->constrained('users', 'id')->onDelete('cascade');
            $table->foreignId('stok_barang_id')->constrained('stok_barang', 'id')->onDelete('cascade');
            $table->integer('jumlah');
            $table->date('tanggal');
            $table->decimal('total_harga', 15, 2)->default(0);
            $table->enum('status', ['proses', 'selesai'])->default('proses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
