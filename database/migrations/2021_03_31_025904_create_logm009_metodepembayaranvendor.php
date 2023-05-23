<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogm009Metodepembayaranvendor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logm009_metodepembayaranvendor', function (Blueprint $table) {
            $table->increments('id');
            $table->biginteger('Vendor_ID');
            $table->biginteger('Metodepembayaran_ID');
            $table->biginteger('Bank_ID');
            $table->biginteger('Norek');
            
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
        Schema::dropIfExists('logm009_metodepembayaranvendor');
    }
}
