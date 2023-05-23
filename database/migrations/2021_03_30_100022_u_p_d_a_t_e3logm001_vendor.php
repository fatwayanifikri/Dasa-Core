<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UPDATE3logm001Vendor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('logm001_vendor', function (Blueprint $table) {
            $table->string('Kota')->after('Alamat');
            $table->string('Propinsi')->after('Kota');
            $table->integer('Kodepos')->after('Propinsi');
            $table->integer('Nofax')->after('Telepon');
            $table->text('Email')->after('AlamatPIC');
            $table->biginteger('Jenisusaha_ID')->after('Email');
            $table->string('Foto1')->after('Jenisusaha_ID');
            $table->string('Foto2')->after('Foto1');
            $table->string('Foto3')->after('Foto2');
            $table->biginteger('Jenispenyediaan_ID')->after('Foto3');
            $table->biginteger('Jeniskelangkaan_ID')->after('Jenispenyediaan_ID');
            $table->string('Keterangan')->after('Jeniskelangkaan_ID');

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
        Schema::table('logm001_vendor', function (Blueprint $table) {
            //
        });
    }
}
