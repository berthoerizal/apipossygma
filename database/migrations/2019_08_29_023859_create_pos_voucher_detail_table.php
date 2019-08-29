<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosVoucherDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_voucher_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('voucher_id');
            $table->string('kode_voucher')->nullable();
            $table->bigInteger('nominal')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('pos_voucher_detail');
    }
}
