<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Createlogm102Penambahanbahanbakudetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logt102_penambahanbahanbakudetail', function (Blueprint $table) {
            $table->increments('id');
            $table->biginteger('penambahanbahanbaku_id');
            $table->biginteger('barang_id');
            $table->integer('jumlah');
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
        Schema::dropIfExists('logt102_penambahanbahanbakudetail');
    }
}
