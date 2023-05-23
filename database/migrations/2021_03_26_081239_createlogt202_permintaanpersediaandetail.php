<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Createlogt202Permintaanpersediaandetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logt202_permintaanpersediaandetail', function (Blueprint $table) {
            $table->increments('id');
            $table->biginteger('permintaanpersediaandetail_id');
            $table->biginteger('barang_id');
            $table->string('namabarang');
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
        Schema::dropIfExists('logt202_permintaanpersediaandetail');
    }
}
