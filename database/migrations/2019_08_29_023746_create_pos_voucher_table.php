<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosVoucherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_voucher', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_utama_voucher');
            $table->string('nama_voucher');
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_akhir')->nullable();
            $table->bigInteger('jumlah')->nullable();
            $table->text('keterangan')->nullable();
            $table->bigInteger('nominal_voucher')->nullable();
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
        Schema::dropIfExists('pos_voucher');
    }
}
