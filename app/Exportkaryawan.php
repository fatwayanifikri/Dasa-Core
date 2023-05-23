<?php

/*-----------------------MODEL UNTUK EXPORT DATA ABSEN LEMBUR-----------------------*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class Exportkaryawan extends Model
{
   public $table = "hrde200_employee";
   public $table2="hrdm101_unit";
   public $table3="hrdm100_company";
   public $table4="hrdm102_departement";
   public $table5="cms_privileges";


   public $fillable = ['Departement_id','Employee_id','Unit_id','Company_id','Jabatan_id','EmployeeName','StartTime','EndTime','UnitName','CompanyName','DepartementName','name'];
}