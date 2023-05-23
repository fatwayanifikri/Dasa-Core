<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Createlogm101Penambahanbahanbaku extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logt101_penambahanbahanbaku', function (Blueprint $table) {
            $table->increments('id');
            $table->date('Tanggal');
            $table->boolean('IsStatus');
            $table->biginteger('IsApproved');
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
        Schema::dropIfExists('logt101_penambahanbahanbaku');
    }
}
