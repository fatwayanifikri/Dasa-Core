<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHRDm100Company extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HRDm100_Company', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->string('CompanyName')->nullable();
            $table->string('Company_Logo')->nullable();
            $table->string('Company_Logo_Kecil')->nullable();
            
            $table->timestamps();
        });

        DB::statement('ALTER TABLE HRDm100_Company CHANGE id id BIGINT(20) UNSIGNED NOT NULL;');
        DB::statement('ALTER TABLE HRDm100_Company ALTER COLUMN id SET DEFAULT uuid_short()');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('HRDm100_Company');
    }
}
