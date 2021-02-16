<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateP103ResignEmployee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('P103_ResignEmployee', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->bigInteger('Employee_id')->nullable();
            $table->bigInteger('Unit_id')->nullable();
            $table->bigInteger('Jabatan_id')->nullable();
            $table->bigInteger('Company_id')->nullable();
            $table->string('EmployeeName')->nullable();
            $table->string('Alasan')->nullable();
            $table->date('TanggalKeluar')->nullable();
            $table->index(['id','Employee_id']);
            $table->index(['id','Unit_id']);
            $table->index(['id','Jabatan_id']);
            $table->index(['id','Company_id']);
            
            $table->timestamps();
        });

        DB::statement('ALTER TABLE P103_ResignEmployee CHANGE id id BIGINT(20) UNSIGNED NOT NULL;');
        DB::statement('ALTER TABLE P103_ResignEmployee ALTER COLUMN id SET DEFAULT uuid_short()');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('P103_ResignEmployee');
    }
}
