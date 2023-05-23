<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateLogt202Purchaserequestdetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('logt202_purchaserequestdetail', function (Blueprint $table) {
            $table->biginteger('created_by')->after('created_at');
            $table->biginteger('updated_by')->after('updated_at');
             $table->datetime('deleted_at')->after('updated_by');
             $table->biginteger('deleted_by')->after('deleted_at');
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
