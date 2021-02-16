<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAttributeHRDe100Pelamar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hrde100_pelamar', function (Blueprint $table) {
            $table->bigInteger('Jabatan_id')->nullable();
            $table->integer('Gaji')->nullabale();
            $table->string('Email')->nullable();
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
