<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTableP103Mutation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p103_mutation', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->date('TanggalMutasi');
            $table->Biginteger('AsalUnit_id');
            $table->Biginteger('AsalPrivilages_id');
            $table->Biginteger('Unit_id');
            $table->Biginteger('Privilages_id');
            $table->Text('Note');
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
        Schema::dropIfExists('p103_mutation');
    }
}
