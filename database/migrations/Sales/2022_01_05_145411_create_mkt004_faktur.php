<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMkt004Faktur extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('mkt004_faktur', function (Blueprint $table) {
            $table->increments('id') ;
            $table->bigInteger('Costumer_ID')->nullable();
            $table->string('Nomor')->nullable();
            $table->string('Perihal')->nullable();
            $table->string('Tgl_request')->nullable();

            $table->string('CompanyName')->nullable();
            $table->string('CompanyAddress')->nullable();
            $table->string('CompanyPhoneNumber')->nullable();

            $table->string('CustomerName')->nullable();
            $table->string('CostumerAddress')->nullable();
            $table->string('CustomerPhoneNumber')->nullable();
            $table->string('CustomerEmail')->nullable();

            $table->string('Barang')->nullable();
            $table->integer('Jumlah')->nullable();
            $table->integer('Harga')->nullable();
            $table->integer('Total')->nullable();
            $table->integer('Pajak')->nullable();
            $table->integer('Grand_Total')->nullable();

            $table->integer('SalesID')->nullable();
            $table->integer('ManagerID')->nullable();

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
        Schema::dropIfExists('mkt004_faktur');
    }
}
