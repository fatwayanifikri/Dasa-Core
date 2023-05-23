<?php

/*-----------------------MODEL UNTUK EXPORT DATA ABSEN LEMBUR-----------------------*/
namespace App;
use Illuminate\Database\Eloquent\Model;
class Exportlembur extends Model
{
	public $table = "t112_absenlembur";
   public $fillable = ['Departement_id','Employee_id','Unit_id','Company_id','Jabatan_id','EmployeeName','StartTime','EndTime'];
}