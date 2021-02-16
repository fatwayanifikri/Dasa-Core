<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHRDe203EmployeeJabatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HRDe203_EmployeeJabatan', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->bigInteger('cms_users_id')->nullable();
            $table->bigInteger('Employee_id')->nullable();
            $table->bigInteger('Jabatan_id')->nullable();
            $table->bigInteger('Level_id')->nullable();
            $table->bigInteger('Unit_id')->nullable();
            $table->bigInteger('Company_id')->nullable();
            $table->index(['id','Employee_id']);
            $table->index(['id','Jabatan_id']);
            $table->index(['id','Level_id']);
            $table->index(['id','Unit_id']);
            $table->index(['id','Company_id']);
            $table->timestamps();
        });

        DB::statement('ALTER TABLE HRDe203_EmployeeJabatan CHANGE id id BIGINT(20) UNSIGNED NOT NULL;');
        DB::statement('ALTER TABLE HRDe203_EmployeeJabatan ALTER COLUMN id SET DEFAULT uuid_short()');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('HRDe203_EmployeeJabatan');
    }
}
