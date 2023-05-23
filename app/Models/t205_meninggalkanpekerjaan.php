<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class t205_meninggalkanpekerjaan extends Model
{
    protected $table = 't205_meninggalkanpekerjaan';
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

    public function department()
    {
        return $this->belongsTo(hrdm102_departement::class, 'Departement_id');
    }


   
}

 