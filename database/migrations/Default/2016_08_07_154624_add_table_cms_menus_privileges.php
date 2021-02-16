<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddTableCmsMenusPrivileges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_menus_privileges', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('id_cms_menus')->nullable();
            $table->bigInteger('id_cms_privileges')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cms_menus_privileges');
    }
}
