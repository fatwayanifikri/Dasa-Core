<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHrdm200Pkwt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrdm200_pkwt', function (Blueprint $table) {
            $table->Bigincrements('id');
            $table->Biginteger('Pelamar_id');

            $table->date('StartDate');
            $table->date('EndDate');
            $table->boolean('isStatus');
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
        Schema::dropIfExists('hrdm200_pkwt');
    }
}
