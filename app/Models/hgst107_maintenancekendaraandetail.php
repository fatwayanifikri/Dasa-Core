<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class hgst107_maintenancekendaraandetail extends Model
{
    protected $table = 'hgst107_maintenancekendaraandetail';
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

    public function maintenance()
    {
        return $this->belongsTo(hgst106_maintenancekendaraan::class, 'maintenance_id');
    }


    public function kendaraan2()
    {
        return $this->belongsTo(hgst103_kendaraan::class, 'nopol_id');
    }
   
   
    
}

