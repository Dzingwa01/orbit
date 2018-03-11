<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('surname');
            $table->string('contact_number');
            $table->string('id_number');
            $table->string('user_name');
            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('surname');
            $table->dropColumn('depot');
            $table->dropColumn('contact_number');
            $table->dropColumn('id_number');
            $table->dropColumn('user_name');
            $table->dropColumn('role_id');
        });
    }
}
