<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyShiftsTableAddCreator extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('shifts', function (Blueprint $table) {
            //
            $table->integer('creator_id')->unsigned();
            $table->integer('team_id')->unsigned();
            $table->foreign('creator_id')->references('id')->on('users');
            $table->foreign('team_id')->references('id')->on('teams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('shifts', function (Blueprint $table) {
            //
            $table->dropColumn('creator_id');
            $table->dropColumn('team_id');
        });
    }
}
