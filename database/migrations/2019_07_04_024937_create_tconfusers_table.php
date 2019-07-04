<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTconfusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tconfusers', function (Blueprint $table) {
            $table->bigIncrements('userid');
            $table->string('userkode', 5);
            $table->string('usernama', 50)->unique();
            $table->string('password', 100);
            $table->integer('groupid');
            $table->timestamp('last_access');
            $table->integer('id_karyawan');
            $table->integer('time_reminder');
            $table->integer('en_id');
            $table->char('useractive', 1);
            $table->string('useremail', 45);
            $table->string('usernik', 45);
            $table->string('userpidgin', 45);
            $table->string('userpidgin_hris', 75);
            $table->string('userphone', 45);
            $table->integer('user_ptnr_id');
            $table->string('user_imei', 45);
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
        Schema::dropIfExists('tconfusers');
    }
}
