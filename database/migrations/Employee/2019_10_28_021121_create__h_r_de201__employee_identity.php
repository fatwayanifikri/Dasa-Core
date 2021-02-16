<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHRDe201EmployeeIdentity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HRDe201_EmployeeIdentity', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->bigInteger('Employee_id')->nullable();
            $table->bigInteger('TipeIdentitas_id')->nullable();
            $table->string('NoID')->nullable();
            $table->string('MasaBerlaku')->nullable();
            $table->string('Photo')->nullable();
            $table->index(['id','Employee_id']);
            $table->index(['id','TipeIdentitas_id']);
            $table->timestamps();
        });

        DB::statement('ALTER TABLE HRDe201_EmployeeIdentity CHANGE id id BIGINT(20) UNSIGNED NOT NULL;');
        DB::statement('ALTER TABLE HRDe201_EmployeeIdentity ALTER COLUMN id SET DEFAULT uuid_short()');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('HRDe201_EmployeeIdentity');
    }
}
