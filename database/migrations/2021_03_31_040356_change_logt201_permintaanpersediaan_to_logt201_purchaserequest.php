<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeLogt201PermintaanpersediaanToLogt201Purchaserequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('logt201_purchaserequest', function (Blueprint $table) {
            schema::rename('logt201_permintaanpersediaan','logt201_purchaserequest');
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
