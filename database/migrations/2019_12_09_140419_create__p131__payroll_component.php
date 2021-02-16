<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateP131PayrollComponent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('P131_PayrollComponent', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->bigInteger('Employee_id')->nullable();
            $table->bigInteger('Jabatan_id')->nullable();
            $table->bigInteger('Unit_id')->nullable();
            $table->integer('GajiPokok')->nullable();
            $table->integer('MakanandanTransport')->nullable();
            $table->integer('Skill')->nullable();
            $table->integer('Bpjs')->nullable();
            $table->integer('Pph21')->nullable();
            $table->index(['id','Employee_id']);
            $table->index(['id','Unit_id']);
            $table->index(['id','Jabatan_id']);
            $table->timestamps();
        });

        DB::statement('ALTER TABLE P131_PayrollComponent CHANGE id id BIGINT(20) UNSIGNED NOT NULL;');
        DB::statement('ALTER TABLE P131_PayrollComponent ALTER COLUMN id SET DEFAULT uuid_short()');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('P131_PayrollComponent');
    }
}
