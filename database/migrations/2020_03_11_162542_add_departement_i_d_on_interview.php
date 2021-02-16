<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDepartementIDOnInterview extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hrdt200_interview', function (Blueprint $table) {
            $table->bigInteger('Departement_id')->nullable();
            $table->index(['id','Departement_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hrdt200_interview', function (Blueprint $table) {
            //
        });
    }
}
