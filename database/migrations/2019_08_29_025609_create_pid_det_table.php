<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePidDetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pid_det', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('pid_pi_oid')->nullable();
            $table->integer('pid_oid')->nullable();
            $table->integer('pid_pt_id')->nullable();
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
        Schema::dropIfExists('pid_det');
    }
}
