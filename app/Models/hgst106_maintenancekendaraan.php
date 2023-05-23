<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class hgst106_maintenancekendaraan extends Model
{
    protected $table = 'hgst106_maintenancekendaraan';
    protected $primaryKey = 'id';
    protected $casts = ['id' => 'string' ];

    public function unit()
    {
    	return $this->belongsTo(hrdm101_unit::class, 'Unit_id');
    }

 public function employee()
    {
        return $this->belongsTo(hrde200_employee::class, 'Employee_id');
    }

    public function kendaraan()
    {
        return $this->belongsTo(hgst103_kendaraan::class, 'nopol');
    }
   
    
}

