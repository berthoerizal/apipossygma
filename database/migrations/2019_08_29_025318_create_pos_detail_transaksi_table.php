<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosDetailTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_detail_transaksi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('transaksi_id')->nullable();
            $table->integer('barang_id')->nullable();
            $table->string('kode_barang')->nullable();
            $table->string('nama_barang')->nullable();
            $table->bigInteger('harga_barang')->nullable();
            $table->string('qty')->nullable();
            $table->bigInteger('total_harga')->nullable();
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
        Schema::dropIfExists('pos_detail_transaksi');
    }
}
