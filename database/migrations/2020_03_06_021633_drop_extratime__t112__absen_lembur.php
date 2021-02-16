<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropExtratimeT112AbsenLembur extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t112_absenlembur', function (Blueprint $table) {
            $table->dropColumn('ExtraTimeDate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t112_absenlembur', function (Blueprint $table) {
            //
        });
    }
}
