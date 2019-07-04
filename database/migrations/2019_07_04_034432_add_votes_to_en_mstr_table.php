<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVotesToEnMstrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('en_mstr', function (Blueprint $table) {
            //
            $table->timestamp('en_upd_date')->nullable();
            $table->timestamp('en_dt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('en_mstr', function (Blueprint $table) {
            //
        });
    }
}
