<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class p104_formexit extends Model
{
    protected $table = 'p104_formexit';
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

 