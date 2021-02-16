<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAtrributeHrde203EmployeeJabatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('HRDe200_Employee', function (Blueprint $table) {
            $table->bigInteger('Jabatan_id')->nullable();
            $table->bigInteger('Level_id')->nullable();
            $table->bigInteger('Unit_id')->nullable();
            $table->bigInteger('Company_id')->nullable();
            $table->index(['id','Jabatan_id']);
            $table->index(['id','Level_id']);
            $table->index(['id','Unit_id']);
            $table->index(['id','Company_id']); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('HRDe200_Employee', function (Blueprint $table) {
            $table->dropColumn(['Jabatan_id', 'Level_id', 'Unit_id','Company_id']);
        });
    }
}
