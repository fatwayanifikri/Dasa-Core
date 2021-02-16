<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAliasToHrdm104Jabatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hrdm104_jabatan', function (Blueprint $table) {
            $table->string('Alias')->nullable();
            $table->string('TargetProduktifitas')->nullable();
            $table->boolean('isActive')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hrdm104_jabatan', function (Blueprint $table) {
            //
        });
    }
}
