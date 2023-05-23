<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateLogm002Coa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('logm002_coa', function (Blueprint $table) {
            $table->biginteger('Tipecoa1_ID')->after('id');
            $table->biginteger('Tipecoa2_ID')->after('Tipecoa1_id');
            $table->biginteger('Tipecoa3_ID')->after('Tipecoa2_id');

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
        Schema::table('logm002_coa', function (Blueprint $table) {
            //
        });
    }
}
