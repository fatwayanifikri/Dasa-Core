<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHRDm109Klasifikasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HRDm109_Klasifikasi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Klasifikasi')->nullable();
            $table->timestamps();
        });
        DB::statement('ALTER TABLE HRDm109_Klasifikasi CHANGE id id BIGINT(20) UNSIGNED NOT NULL;');
        DB::statement('ALTER TABLE HRDm109_Klasifikasi ALTER COLUMN id SET DEFAULT uuid_short()');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('HRDm109_Klasifikasi');
    }
}
