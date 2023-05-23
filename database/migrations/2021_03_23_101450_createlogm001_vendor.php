<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Createlogm001Vendor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logm001_vendor', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Nama');
            $table->string('Alamat');
            $table->string('Telepon');
            $table->string('NPWP');
            $table->string('PIC');
            $table->string('TeleponPIC');
            $table->string('AlamatPIC');
            $table->boolean('IsStatus');
            $table->string('IsApproved');
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
        Schema::dropIfExists('logm001_vendor');
    }
}
