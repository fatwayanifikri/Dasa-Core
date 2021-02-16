<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m101_unit', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->text('UnitName')->nullable();
            $table->text('UnitLogo')->nullable();
            $table->text('UnitLogoSmall')->nullable();

            $table->timestamps();
        });

        DB::statement('ALTER TABLE m101_unit CHANGE id id BIGINT(20) UNSIGNED NOT NULL;');
        DB::statement('ALTER TABLE m101_unit ALTER COLUMN id SET DEFAULT uuid_short()');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m101_unit');
    }
}
