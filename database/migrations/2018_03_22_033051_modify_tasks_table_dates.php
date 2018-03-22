<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyTasksTableDates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            //
            $table->renameColumn('task_date','start_date');

            $table->dateTime('end_date');

        });
        Schema::table('tasks', function (Blueprint $table) {
            //
            $table->dateTime('start_date')->change();

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            //
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
        });
    }
}
