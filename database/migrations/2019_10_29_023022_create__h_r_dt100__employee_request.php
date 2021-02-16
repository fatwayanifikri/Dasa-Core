<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHRDt100EmployeeRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HRDt100_EmployeeRequest', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->string('NomerDokumen')->nullable();
            $table->bigInteger('Employee_id')->nullable();
            $table->bigInteger('Unit_id')->nullable();
            $table->bigInteger('Jabatan_id')->nullable();
            $table->bigInteger('Company_id')->nullable();
            $table->date('RequestDate')->nullable();
            $table->index('id','Employee_id');
            $table->index('id','Unit_id');
            $table->index('id','Jabatan_id');
            $table->index('id','Company_id');
            $table->timestamps();
        });

        DB::statement('ALTER TABLE HRDt100_EmployeeRequest CHANGE id id BIGINT(20) UNSIGNED NOT NULL;');
        DB::statement('ALTER TABLE HRDt100_EmployeeRequest ALTER COLUMN id SET DEFAULT uuid_short()');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('HRDt100_EmployeeRequest');
    }
}
