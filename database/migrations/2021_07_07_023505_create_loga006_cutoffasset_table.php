<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoga006CutoffassetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loga006_cutoffasset', function (Blueprint $table) {
            $table->increments('id');
            $table->char('kode');
            $table->text('nama');
             $table->integer('kategori_id');
             $table->integer('Unit_id');
             $table->biginteger('created_by')->after('created_at');

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
        Schema::dropIfExists('loga006_cutoffasset');
    }
}
