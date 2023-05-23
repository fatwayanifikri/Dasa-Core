<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Change2Logt201PermintaanpersediaanToLogt201Purchaserequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('logt201_purchaserequest', function (Blueprint $table) {
            $table->string('NoPR')->after('id');
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
        Schema::table('logt201_purchaserequest', function (Blueprint $table) {
            //
        });
    }
}
