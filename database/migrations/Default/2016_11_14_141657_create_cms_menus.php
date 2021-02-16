<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCmsMenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('type')->default('url');
            $table->string('path')->nullable();
            $table->string('color')->nullable();
            $table->string('icon')->nullable();
            $table->bigInteger('parent_id')->nullable();
            $table->boolean('is_active')->default(1);
            $table->boolean('is_dashboard')->default(0);
            $table->bigInteger('id_cms_privileges')->nullable();
            $table->bigInteger('sorting')->nullable();

            $table->bigInteger('parent_baum')->nullable();
            $table->bigInteger('lft')->nullable();
            $table->bigInteger('rgt')->nullable();
            $table->bigInteger('depth')->nullable();
            $table->index(['parent_baum','lft','rgt','depth']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cms_menus');
    }
}
