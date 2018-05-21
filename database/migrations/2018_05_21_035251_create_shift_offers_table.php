<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShiftOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shift_offers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("offer_shit")->unsigned();
            $table->integer('team_member')->unsigned();
            $table->integer('employee_id')->unsigned();
            $table->text('reason');

            $table->foreign('offer_shit')->references('id')->on('shift_schedules');
            $table->foreign('team_member')->references('id')->on('users');
            $table->foreign('employee_id')->references('id')->on('users');
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
        Schema::dropIfExists('shift_offers');
    }
}
