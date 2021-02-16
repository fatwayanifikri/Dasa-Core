<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStartdateToHrde204Employeestatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hrde204_employeestatus', function (Blueprint $table) {
            $table->date('Start')->nullable();
            $table->date('End')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hrde204_employeestatus', function (Blueprint $table) {
            //
        });
    }
}
