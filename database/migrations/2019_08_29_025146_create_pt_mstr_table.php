<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePtMstrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pt_mstr', function (Blueprint $table) {
            $table->bigIncrements('pt_id');
            $table->string('pt_code')->nullable();
            $table->text('pt_desc1')->nullable();
            $table->text('pt_desc2')->nullable();
            $table->string('pt_gambar')->nullable();
            $table->string('pt_type')->nullable();
            $table->string('pt_ppn_type')->nullable();
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
        Schema::dropIfExists('pt_mstr');
    }
}
