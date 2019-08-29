<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTconfuserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tconfuser', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('usernama');
            $table->string('password');
            $table->integer('en_id')->nullable();
            $table->integer('userid')->nullable();
            $table->integer('user_ptnr_id')->nullable();
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
        Schema::dropIfExists('tconfuser');
    }
}
