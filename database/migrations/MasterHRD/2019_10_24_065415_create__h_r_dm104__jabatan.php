<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHRDm104Jabatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HRDm104_Jabatan', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->biginteger('Level_id')->nullable();
            $table->string('NamaJabatan')->nullable();
            $table->index(['id','Level_id']);
            $table->timestamps();
        });

        DB::statement('ALTER TABLE HRDm104_Jabatan CHANGE id id BIGINT(20) UNSIGNED NOT NULL;');
        DB::statement('ALTER TABLE HRDm104_Jabatan ALTER COLUMN id SET DEFAULT uuid_short()');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('HRDm104_Jabatan');
    }
}
