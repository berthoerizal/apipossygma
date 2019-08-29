<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_transaksi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('meja_id')->nullable();
            $table->string('nama_pelanggan');
            $table->bigInteger('bayar')->nullable();
            $table->integer('shift_id')->nullable();
            $table->date('tanggal_transaksi')->nullable();
            $table->integer('pricelist_id')->nullable();
            $table->integer('member_id')->nullable();
            $table->integer('voucher_id')->nullable();
            $table->string('kode_voucher')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('pos_transaksi');
    }
}
