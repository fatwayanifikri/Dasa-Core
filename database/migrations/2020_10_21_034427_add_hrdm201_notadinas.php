<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHrdm201Notadinas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrdm201_notadinas', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->biginteger('pkwt_id');
            $table->biginteger('Pelamar_id');
            $table->biginteger('DokStatus');
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
        Schema::dropIfExists('hrdm201_notadinas');
    }
}
