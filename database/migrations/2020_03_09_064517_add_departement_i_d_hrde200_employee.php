<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDepartementIDHrde200Employee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hrde200_employee', function (Blueprint $table) {
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
        Schema::table('hrde200_employee', function (Blueprint $table) {
            //
        });
    }
}
