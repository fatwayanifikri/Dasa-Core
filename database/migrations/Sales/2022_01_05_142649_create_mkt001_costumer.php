<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMkt001Costumer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mkt001_costumer', function (Blueprint $table) {
            $table->integer('id') ;
            $table->bigincrements('CustID')->nullable();
            $table->integer('StoreID')->nullable();
            $table->string('CompanyName')->nullable();
            $table->string('CompanyAddress')->nullable();
            $table->string('CompanyZipPostal')->nullable();
            $table->string('CompanyNPWP')->nullable();
            $table->string('CompanyPhoneNumber')->nullable();
            $table->string('CompanyFaxNumber')->nullable();
            $table->string('CompanyTypeOfBusiness')->nullable();
            $table->string('CompanyEmail')->nullable();
            $table->string('CustomerName')->nullable();
            $table->string('CostumerAddress')->nullable();
            $table->string('CustomerPhoneNumber')->nullable();
            $table->string('CustomerEmail')->nullable();
            $table->integer('isSpecialCust')->nullable();
            $table->integer('isSpecialCustApproval');
            $table->integer('isActive')->nullable();
            $table->integer('isActiveApproval')->nullable();
            $table->text('Description')->nullable();
            $table->text('NotesApproval')->nullable();
            $table->string('CreatedUser')->nullable();
            $table->date('CreatedDate')->nullable();
            $table->integer('UserIDSales')->nullable();
            $table->string('LastModifiedUser')->nullable();
            $table->date('LastModifiedDate')->nullable();
            $table->timestamps();
        });

        DB::statement('ALTER TABLE mkt001_costumer ALTER COLUMN id SET DEFAULT AUTO_INCREMENT()');
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mkt001_costumer');
    }
}
