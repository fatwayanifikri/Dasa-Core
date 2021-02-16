<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHRDt200Interview extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HRDt200_Interview', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->bigInteger('Pelamar_id')->nullable();
            $table->bigInteger('Jabatan_id')->nullable();
            $table->bigInteger('Unit_id')->nullable();
            $table->bigInteger('Company_id')->nullable();
            $table->date('Tanggal')->nullable();
            $table->time('Jam')->nullable();
            $table->string('Kesehatan')->nullable();
            $table->string('StatusHadir')->nullable();
            $table->date('TanggalPesikotes')->nullable();
            $table->string('KeteranganPsikotes')->nullable();
            $table->date('TanggalInterview')->nullable();
            $table->string('KeteranganInterview')->nullable(); 
            $table->date('TanggalPraktek')->nullable();
            $table->string('KeteranganPraktek')->nullable();
            $table->date('TanggalMulai')->nullable();
            $table->string('Keterangan')->nullable();  
            $table->index(['id','Pelamar_id']);
            $table->index(['id','Jabatan_id']);
            $table->index(['id','Unit_id']);
            $table->index(['id','Company_id']);
            $table->timestamps();
        });

        DB::statement('ALTER TABLE HRDt200_Interview CHANGE id id BIGINT(20) UNSIGNED NOT NULL;');
        DB::statement('ALTER TABLE HRDt200_Interview ALTER COLUMN id SET DEFAULT uuid_short()');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('HRDt200_Interview');
    }
}
