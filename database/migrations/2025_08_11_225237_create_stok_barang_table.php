<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStokBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stok_barang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barang_id');
            $table->string('kode')->unique();
            $table->string('ukuran', 20);
            $table->integer('stok')->default(0);
            $table->decimal('harga', 10, 2)->default(0);
            $table->string('satuan', 20);
            $table->string('foto')->nullable();

            $table->timestamps();

            $table->foreign('barang_id')
                ->references('id')->on('barang')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stok_barang');
    }
}
