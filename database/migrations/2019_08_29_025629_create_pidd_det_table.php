<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePiddDetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pidd_det', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('pidd_pid_oid')->nullable();
            $table->bigInteger('pidd_price')->nullable();
            $table->bigInteger('pidd_payment')->nullable();
            $table->string('pidd_disc')->nullable();
            $table->string('pidd_payment_type')->nullable();
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
        Schema::dropIfExists('pidd_det');
    }
}
