<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHRDm108EmployeeStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HRDm108_EmployeeStatus', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->string('StatusName')->nullable();
            $table->timestamps();
        });

        DB::statement('ALTER TABLE HRDm108_EmployeeStatus CHANGE id id BIGINT(20) UNSIGNED NOT NULL;');
        DB::statement('ALTER TABLE HRDm108_EmployeeStatus ALTER COLUMN id SET DEFAULT uuid_short()');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('HRDm108_EmployeeStatus');
    }
}
