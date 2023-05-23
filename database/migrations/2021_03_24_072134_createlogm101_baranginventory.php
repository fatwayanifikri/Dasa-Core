<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Createlogm101Baranginventory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logm101_baranginventory', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Kodebarang');
            $table->string('NamaBarang');
            $table->biginteger('Coa_id');
            $table->biginteger('Kategori_id');
            $table->biginteger('Gudang_id');
            $table->integer('Stok');
            $table->string('Satuan');
            $table->decimal('Hargajual');
            $table->decimal('Hargareal');
            $table->decimal('Hargabeli');
            $table->boolean('Isstatus');
            $table->string('Isapproved');
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
        Schema::dropIfExists('logm101_baranginventory');
    }
}
