<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class p103_resignemployee extends Model
{
    protected $table = 'p103_resignemployee';
    protected $primaryKey = 'id';
    protected $casts = ['id' => 'string' ];

    
    public function unit()
    {
        return $this->belongsTo(hrdm101_unit::class, 'Unit_id');
    }
     public function jabatan()
    {
        return $this->belongsTo(cms_privileges::class, 'Jabatan_id');
    }

    public function company()
    {
    	return $this->belongsTo(hrdm100_company::class, 'Company_id');
    }

   
}

