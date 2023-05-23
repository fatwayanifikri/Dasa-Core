<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeLogt202PermintaanpersediaandetailToLogt202Purchaserequestdetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('logt202_purchaserequestdetail', function (Blueprint $table) {
            schema::rename('logt202_permintaanpersediaandetail','logt202_purchaserequestdetail');
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
        Schema::table('logt202_purchaserequestdetail', function (Blueprint $table) {
            //
        });
    }
}
