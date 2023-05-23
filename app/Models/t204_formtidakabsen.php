<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class t204_formtidakabsen extends Model
{
    protected $table = 't204_formtidakabsen';
    protected $primaryKey = 'id';
    protected $casts = ['id' => 'string' ];

     public function employee()
    {
    	return $this->belongsTo(hrde200_employee::class, 'Employee_id');
    }
    
     public function unit()
    {
    	return $this->belongsTo(hrdm101_unit::class, 'Unit_id');
    }
     
    public function jabatan()
    {
    	return $this->belongsTo(cms_privileges::class, 'Jabatan_id');
    }


   
}

 