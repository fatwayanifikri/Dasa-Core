<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateLogt301Puchaseorder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('logt301_purchaseorder', function (Blueprint $table) {
            $table->biginteger('purchaserequest_ID')->after('id');
            $table->biginteger('vendor_ID')->after('purchaserequest_ID');
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
        Schema::table('logt301_purchaseorder', function (Blueprint $table) {
            //
        });
    }
}
