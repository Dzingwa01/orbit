<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifySwapShifts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('swap_shifts', function (Blueprint $table) {
            //
            $table->boolean('approval')->nullable();
            $table->integer('requestor_id')->unsigned();

            $table->foreign('requestor_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('swap_shifts', function (Blueprint $table) {
            //
            $table->dropColumn('approval');
            $table->dropColumn('requestor_id');
        });
    }
}
