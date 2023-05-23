<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class T204Formtidakabsen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t204_formtidakabsen', function (Blueprint $table) {
            $table->increments('id');
            $table->biginteger('Employee_id');
            $table->integer('Jabatan_id');
            $table->integer('Unit_id');
            $table->datetime('tanggal');
            $table->char('jam_pelaksanaan');
            $table->text('keterangan');
            $table->timestamps();
            $table->integer('is_approve');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t204_formtidakabsen');
    }
}
