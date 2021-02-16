<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrdt201Interviewapproval extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrdt201_interviewapproval', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->bigInteger('Interview_id')->nullable();
            $table->boolean('isApproved')->nullable();
            $table->integer('Approvedby')->nullable();
            $table->datetime('ApprovedDate')->nullable();
            $table->string('Keterangan')->nullable();
            $table->index(['id','Interview_id']);
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
        Schema::dropIfExists('hrdt201_interviewapproval');
    }
}
