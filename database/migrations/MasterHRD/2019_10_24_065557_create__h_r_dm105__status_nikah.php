<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHRDm105StatusNikah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HRDm105_StatusNikah', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->string('StatusNikah')->nullable();
            $table->timestamps();
        });
        DB::statement('ALTER TABLE HRDm105_StatusNikah CHANGE id id BIGINT(20) UNSIGNED NOT NULL;');
        DB::statement('ALTER TABLE HRDm105_StatusNikah ALTER COLUMN id SET DEFAULT uuid_short()');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('HRDm105_StatusNikah');
    }
}
