<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FromdateToDateTimeT112Absenlembur extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t112_absenlembur', function (Blueprint $table) {
            $table->dateTime('StartTime')->nullable()->change();
            $table->dateTime('EndTime')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t112_absenlembur', function (Blueprint $table) {
            //
        });
    }
}
