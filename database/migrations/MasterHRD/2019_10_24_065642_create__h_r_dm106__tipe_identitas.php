<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHRDm106TipeIdentitas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HRDm106_TipeIdentitas', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->string('NamaID')->nullable();
            $table->timestamps();
        });

        DB::statement('ALTER TABLE HRDm106_TipeIdentitas CHANGE id id BIGINT(20) UNSIGNED NOT NULL;');
        DB::statement('ALTER TABLE HRDm106_TipeIdentitas ALTER COLUMN id SET DEFAULT uuid_short()');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('HRDm106_TipeIdentitas');
    }
}
