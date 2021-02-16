<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHRDe101PelamarIdentity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HRDe101_PelamarIdentity', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->bigInteger('Pelamar_id')->nullable();
            $table->bigInteger('TipeIdentitas_id')->nullable();
            $table->string('NoID')->nullable();
            $table->string('MasaBerlaku')->nullable();
            $table->string('Photo')->nullable();
            $table->index(['id','Pelamar_id']);
            $table->index(['id','TipeIdentitas_id']);
            $table->timestamps();
        });
        DB::statement('ALTER TABLE HRDe101_PelamarIdentity CHANGE id id BIGINT(20) UNSIGNED NOT NULL;');
        DB::statement('ALTER TABLE HRDe101_PelamarIdentity ALTER COLUMN id SET DEFAULT uuid_short()');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('HRDe101_PelamarIdentity');
    }
}
