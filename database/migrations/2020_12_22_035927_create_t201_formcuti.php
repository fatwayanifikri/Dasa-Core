<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateT201Formcuti extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t201_formcuti', function (Blueprint $table) {
            $table->Bigincrements('id');
            $table->Biginteger('Employee_id');
            $table->Biginteger('Jabatan_id');
            $table->Biginteger('Unit_id');
            $table->Biginteger('Jeniscuti_id');
            $table->string('Tujuan');
            $table->integer('Lama');
            $table->string('Pelaksanaan');
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
        Schema::dropIfExists('t201_formcuti');
    }
}
