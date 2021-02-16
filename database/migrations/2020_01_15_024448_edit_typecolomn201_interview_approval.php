<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditTypecolomn201InterviewApproval extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hrdt201_interviewapproval', function (Blueprint $table) {
            $table->string('isApproved',25)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hrdt201_interviewapproval', function (Blueprint $table) {
            //
        });
    }
}
