<?php

/*-----------------------MODEL UNTUK EXPORT DATA ABSEN LEMBUR-----------------------*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class Exportmutasi extends Model
{
	public $table = "p101_mutation";
	public $table2 = "hrde200_employee";
   public $table3="hrdm101_unit";
   public $table4="hrdm100_company";
   public $table5="cms_privileges";

   public $fillable = ['UnitName','EmployeeName','NPK','Note','name','UnitName','name','TanggalMutasi'];
}