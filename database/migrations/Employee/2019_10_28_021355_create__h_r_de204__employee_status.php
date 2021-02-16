<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHRDe204EmployeeStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HRDe204_EmployeeStatus', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->bigInteger('Employee_id')->nullable();
            $table->bigInteger('EmployeeStatus_id')->nullable();
            $table->index(['id','Employee_id']);
            $table->index(['id','EmployeeStatus_id']);
            $table->timestamps();
        });

        DB::statement('ALTER TABLE HRDe204_EmployeeStatus CHANGE id id BIGINT(20) UNSIGNED NOT NULL;');
        DB::statement('ALTER TABLE HRDe204_EmployeeStatus ALTER COLUMN id SET DEFAULT uuid_short()');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('HRDe204_EmployeeStatus');
    }
}
