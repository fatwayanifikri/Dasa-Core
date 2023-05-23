<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Createlogt301Purchaseorder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logt301_purchaseorder', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal');
            $table->integer('IsStatus');
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
        Schema::dropIfExists('logt301_purchaseorder');
    }
}
