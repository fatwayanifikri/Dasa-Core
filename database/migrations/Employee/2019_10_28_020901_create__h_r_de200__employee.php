<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHRDe200Employee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HRDe200_Employee', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->bigInteger('cms_users_id')->nullable();
            $table->string('NPK')->nullable();
            $table->string('EmployeeName')->nullable();
            $table->string('TempatLahir')->nullable();
            $table->date('TanggalLahir')->nullable();
            $table->boolean('JenisKelamin')->nullable();
            $table->bigInteger('StatusNikah_id')->nullable();
            $table->date('HiredDate')->nullable();
            $table->string('AlamatRumah')->nullable();
            $table->string('TelpRumah')->nullable();
            $table->string('TelpHp')->nullable();
            $table->string('Keterangan')->nullable();
            $table->index(['id','StatusNikah_id']);
            $table->timestamps();
        });

        DB::statement('ALTER TABLE HRDe200_Employee CHANGE id id BIGINT(20) UNSIGNED NOT NULL;');
        DB::statement('ALTER TABLE HRDe200_Employee ALTER COLUMN id SET DEFAULT uuid_short()');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('HRDe200_Employee');
    }
}
