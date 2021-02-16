<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHRDt101DetailRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HRDt101_DetailRequest', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->bigInteger('EmployeeRequest_id')->nullable();
            $table->bigInteger('Jabatan_id')->nullable();
            $table->string('AlasanRequest')->nullable();
            $table->string('ExKaryawan')->nullable();
            $table->string('AlasanKeluar')->nullable();
            $table->string('Kualifikasi')->nullable();
            $table->integer('Jumlah')->nullable();
            $table->date('StartDate')->nullable();
            $table->string('NamaEmployee')->nullable();
            $table->date('EntryDate')->nullable();
            $table->string('Keterangan')->nullable();
            $table->string('StatusTerpenuhi')->nullable();
            $table->index(['id','EmployeeRequest_id']);
            $table->index(['id','Jabatan_id']);
            $table->timestamps();
        });

        DB::statement('ALTER TABLE HRDt101_DetailRequest CHANGE id id BIGINT(20) UNSIGNED NOT NULL;');
        DB::statement('ALTER TABLE HRDt101_DetailRequest ALTER COLUMN id SET DEFAULT uuid_short()');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('HRDt101_DetailRequest');
    }
}
