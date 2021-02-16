<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateITt900Pica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ITt900_Pica', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->string('Description')->nullable();
            $table->string('Pelapor')->nullable();
            $table->bigInteger('Unit_id')->nullable();
            $table->date('DateReport')->nullable();
            $table->string('AnalisaPenyebab')->nullable();
            $table->bigInteger('Klasifikasi_id')->nullable();
            $table->string('Solusi')->nullable();
            $table->date('DateEnd')->nullable();
            $table->bigInteger('Employee_id')->nullable();
            $table->index(['id','Unit_id']);
            $table->index(['id','Klasifikasi_id']);
            $table->index(['id','Employee_id']);
            $table->timestamps();
        });

        DB::statement('ALTER TABLE ITt900_Pica CHANGE id id BIGINT(20) UNSIGNED NOT NULL;');
        DB::statement('ALTER TABLE ITt900_Pica ALTER COLUMN id SET DEFAULT uuid_short()');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ITt900_Pica');
    }
}
