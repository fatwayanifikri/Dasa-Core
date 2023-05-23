<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update4Logt302Puchaseorderdetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('logt302_purchaseorderdetail', function (Blueprint $table) {
            $table->biginteger('Baranginventory_ID')->after('id');
            $table->integer('Harga')->after('Baranginventory_ID');
            $table->integer('Jumlah')->after('Harga');
            
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
        Schema::table('logt302_purchaseorderdetail', function (Blueprint $table) {
            //
        });
    }
}
