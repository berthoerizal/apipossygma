<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosOutletTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_outlet', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('entitas_id')->nullable();
            $table->string('nama_outlet')->nullable();
            $table->text('alamat')->nullable();
            $table->integer('no_outlet')->nullable();
            $table->integer('loc_id')->nullable();
            $table->integer('bk_id')->nullable();
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
        Schema::dropIfExists('pos_outlet');
    }
}
