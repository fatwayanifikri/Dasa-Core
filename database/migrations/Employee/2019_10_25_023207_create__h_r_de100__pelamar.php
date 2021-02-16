<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHRDe100Pelamar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HRDe100_Pelamar', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('NamaPelamar')->nullable();
            $table->string('TempatLahir')->nullable();
            $table->date('TanggalLahir')->nullable();
            $table->bigInteger('StatusNikah_id')->nullable();
            $table->string('Alamat')->nullable();
            $table->string('TelpRumah')->nullable();
            $table->string('TelpHp')->nullable();
            $table->string('Keterangan')->nullable();
            $table->index(['id','StatusNikah_id']);
            $table->timestamps();
        });

        DB::statement('ALTER TABLE HRDe100_Pelamar CHANGE id id BIGINT(20) UNSIGNED NOT NULL;');
        DB::statement('ALTER TABLE HRDe100_Pelamar ALTER COLUMN id SET DEFAULT uuid_short()');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('HRDe100_Pelamar');
    }
}
