<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHRDm107EducationLevel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HRDm107_EducationLevel', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->string('EducationName')->nullable();
            $table->timestamps();
        });

        DB::statement('ALTER TABLE HRDm107_EducationLevel CHANGE id id BIGINT(20) UNSIGNED NOT NULL;');
        DB::statement('ALTER TABLE HRDm107_EducationLevel ALTER COLUMN id SET DEFAULT uuid_short()');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('HRDm107_EducationLevel');
    }
}
