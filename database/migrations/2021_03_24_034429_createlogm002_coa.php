<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Createlogm002Coa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logm002_coa', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Nomorcoa');
            $table->string('Namacoa');
            $table->biginteger('Tipecoa_ID');
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
        Schema::dropIfExists('logm002_coa');
    }
}
