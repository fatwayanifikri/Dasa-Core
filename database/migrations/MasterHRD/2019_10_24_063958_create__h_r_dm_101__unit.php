<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHRDm101Unit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HRDm101_Unit', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->bigInteger('Company_id')->nullable();
            $table->string('UnitName')->nullable();
            $table->string('UnitInitial')->nullable();
            $table->string('Unit_Logo')->nullable();
            $table->string('Unit_Logo_Kecil')->nullable();
            $table->timestamps();
            $table->index(['id','Company_id']);
        });

        DB::statement('ALTER TABLE HRDm101_Unit CHANGE id id BIGINT(20) UNSIGNED NOT NULL;');
        DB::statement('ALTER TABLE HRDm101_Unit ALTER COLUMN id SET DEFAULT uuid_short()');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('HRDm101_Unit');
    }
}
