<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update2Logt302Puchaseorderdetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('logt302_purchaseorderdetail', function (Blueprint $table) {
            $table->string('NoPO')->after('id');
            $table->string('NoPR')->after('NoPO');
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
