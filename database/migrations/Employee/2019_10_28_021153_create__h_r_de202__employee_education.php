<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHRDe202EmployeeEducation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HRDe202_EmployeeEducation', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->bigInteger('Employee_id')->nullable();
            $table->bigInteger('EducationLevel_id')->nullable();
            $table->string('EducationName')->nullable();
            $table->date('Form')->nullable();
            $table->date('To')->nullable();
            $table->integer('NilaiAkhir')->nullable();
            $table->index(['id','Employee_id']);
            $table->index(['id','EducationLevel_id']);
            $table->timestamps();
        });

        DB::statement('ALTER TABLE HRDe202_EmployeeEducation CHANGE id id BIGINT(20) UNSIGNED NOT NULL;');
        DB::statement('ALTER TABLE HRDe202_EmployeeEducation ALTER COLUMN id SET DEFAULT uuid_short()');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('HRDe202_EmployeeEducation');
    }
}
