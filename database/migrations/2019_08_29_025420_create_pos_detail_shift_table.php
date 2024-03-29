<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosDetailShiftTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_detail_shift', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('shift_id')->nullable();
            $table->bigInteger('nominal')->nullable();
            $table->bigInteger('jml')->nullable();
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
        Schema::dropIfExists('pos_detail_shift');
    }
}
