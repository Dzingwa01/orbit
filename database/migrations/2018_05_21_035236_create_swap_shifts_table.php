<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSwapShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('swap_shifts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("swap_shift")->unsigned();
            $table->integer('with_shift')->unsigned();
            $table->integer('employee_id')->unsigned();
            $table->text('reason');

            $table->foreign('swap_shift')->references('id')->on('shift_schedules');
            $table->foreign('with_shift')->references('id')->on('shift_schedules');
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
        Schema::dropIfExists('swap_shifts');
    }
}
