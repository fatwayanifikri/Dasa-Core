<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColomnHrde100Pelamar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hrde100_pelamar', function (Blueprint $table) {
            $table->boolean('JenisKelamin')->nullable();
            $table->string('Agama')->nullable();
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hrde100_pelamar', function (Blueprint $table) {
            //
        });
    }
}
