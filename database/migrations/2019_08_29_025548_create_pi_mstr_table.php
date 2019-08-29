<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePiMstrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pi_mstr', function (Blueprint $table) {
            $table->bigIncrements('pi_id');
            $table->integer('pi_oid')->nullable();
            $table->string('pi_so_type')->nullable();
            $table->string('pi_active')->nullable();
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
        Schema::dropIfExists('pi_mstr');
    }
}
