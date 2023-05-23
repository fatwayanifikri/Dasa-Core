<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMkt005Fakturdetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('mkt005_fakturdetail', function (Blueprint $table) {
            $table->increments('id') ;
            $table->integer('FakturID')->nullable();
            $table->string('Nomor_faktur')->nullable();
            $table->integer('Custid')->nullable();
            $table->string('nama_barang')->nullable();
            $table->string('detail_barang')->nullable();
            $table->integer('jumlah_barang')->nullable();
            $table->integer('harga_barang')->nullable();
            $table->integer('total_harga')->nullable();
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
        Schema::dropIfExists('mkt005_fakturdetail');
    }
}
