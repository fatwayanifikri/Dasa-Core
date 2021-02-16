<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateT112AbsenLembur extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('T112_AbsenLembur', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('Departement_id')->nullable();
            $table->bigInteger('Employee_id')->nullable();
            $table->bigInteger('Unit_id')->nullable();
            $table->bigInteger('Company_id')->nullable();
            $table->bigInteger('Jabatan_id')->nullable();
            $table->string('EmployeeName')->nullable();
            $table->date('ExtraTimeDate')->nullable();
            $table->time('StartTime')->nullable();
            $table->time('EndTime')->nullable();
            $table->integer('AmountMinute')->nullable();
            $table->string('NomerVoucher')->nullable();
            $table->string('Note')->nullable();
            $table->index(['id','Departement_id']);
            $table->index(['id','Employee_id']);
            $table->index(['id','Unit_id']);
            $table->index(['id','Company_id']);
            $table->index(['id','Jabatan_id']);
            $table->timestamps();
        });

        DB::statement('ALTER TABLE T112_AbsenLembur CHANGE id id BIGINT(20) UNSIGNED NOT NULL;');
        DB::statement('ALTER TABLE T112_AbsenLembur ALTER COLUMN id SET DEFAULT uuid_short()');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('T112_AbsenLembur');
    }
}
