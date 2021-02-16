<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditP103Mutation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('p103_mutation', function (Blueprint $table) {
            //
            $table->renameColumn('AsalPrivilages_id','AsalPrivileges_id');
            $table->renameColumn('Privilages_id','Privileges_id');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('p103_mutation', function (Blueprint $table) {
            //
        });
    }
}
