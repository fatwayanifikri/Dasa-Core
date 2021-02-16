<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrde103Pelamarexperience extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrde103_pelamarexperience', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->bigInteger('Pelamar_id')->nullable();
            $table->string('CorporateName')->nullable();
            $table->string('JabatanTerakhir')->nullable();
            $table->string('PeriodeKerja')->nullable();
            $table->string('DeskripsiPekerjaan')->nullable();
            $table->index(['id','Pelamar_id']);
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
        Schema::dropIfExists('hrde103_pelamarexperience');
    }
}
