<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnMstrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('en_mstr', function (Blueprint $table) {
            $table->bigIncrements('en_oid');
            $table->smallInteger('en_dom_id');
            $table->string('en_add_by',40);
            $table->timestamp('en_add_date');
            $table->string('en_upd_by',40);
            $table->integer('en_id')->unique();
            $table->string('en_code',15);
            $table->string('en_desc',45);
            $table->integer('parent');
            $table->char('en_active', 1);
            $table->string('en_limit_account',1);
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
        Schema::dropIfExists('en_mstr');
    }
}
