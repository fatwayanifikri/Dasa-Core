<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m100_company', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->text('CompanyName')->nullable();
            $table->text('CompanyLogo')->nullable();
            $table->text('CompanyLogoSmall')->nullable();

            $table->timestamps();
        });
        
        DB::statement('ALTER TABLE m100_company CHANGE id id BIGINT(20) UNSIGNED NOT NULL;');
        DB::statement('ALTER TABLE m100_company ALTER COLUMN id SET DEFAULT uuid_short()');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m100_company');
    }
}
