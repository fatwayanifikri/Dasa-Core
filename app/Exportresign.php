<?php

/*-----------------------MODEL UNTUK EXPORT DATA ABSEN LEMBUR-----------------------*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class Exportresign extends Model
{
   public $table = "p103_resignemployee";


   public $fillable = ['Alasan','Employee_id','Unit_id','Company_id','Jabatan_id','EmployeeName','StartTime','EndTime','UnitName','CompanyName','TanggalKeluar','name'];
}