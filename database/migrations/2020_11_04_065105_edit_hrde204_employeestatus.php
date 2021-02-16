<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditHrde204Employeestatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hrde204_employeestatus', function (Blueprint $table) {
            $table->biginteger('NoID')->after('isStatus');
            //
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
