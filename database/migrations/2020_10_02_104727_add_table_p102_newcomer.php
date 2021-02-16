<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTableP102Newcomer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p102_newcomer', function (Blueprint $table) {
            $table->increments('id');
                        $table->Biginteger('Employee_id')->nullable();
            $table->string('EmployeeName')->nullable();
            $table->Biginteger('Privilages_id')->nullable();
            $table->Biginteger('Unit_id')->nullable();
            $table->Date('TanggalMasuk')->nullable();
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
        Schema::dropIfExists('p102_newcomer');
    }
}
