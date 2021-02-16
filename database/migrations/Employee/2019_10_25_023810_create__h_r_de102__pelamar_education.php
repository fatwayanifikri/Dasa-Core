<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHRDe102PelamarEducation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HRDe102_PelamarEducation', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->bigInteger('Pelamar_id')->nullable();
            $table->bigInteger('EducationLevel_id')->nullable();
            $table->string('EducationName')->nullable();
            $table->date('From')->nullable();
            $table->date('To')->nullable();
            $table->integer('NilaiAkhir')->nullable();
            $table->index(['id','Pelamar_id']);
            $table->index(['id','EducationLevel_id']);
            $table->timestamps();
        });

        DB::statement('ALTER TABLE HRDm102_PelamarEducation CHANGE id id BIGINT(20) UNSIGNED NOT NULL;');
        DB::statement('ALTER TABLE HRDm102_PelamarEducation ALTER COLUMN id SET DEFAULT uuid_short()');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('HRDe102_PelamarEducation');
    }
}
