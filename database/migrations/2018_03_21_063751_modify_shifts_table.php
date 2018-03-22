<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyShiftsTable extends Migration
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
            $table->string('shift_title');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->softDeletes();
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
            $table->dropColumn('shift_title');
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
            $table->dropColumn('deleted_at');
        });
    }
}
