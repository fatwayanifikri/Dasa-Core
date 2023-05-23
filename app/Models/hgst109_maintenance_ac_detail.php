<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class hgst109_maintenance_ac_detail extends Model
{
    protected $table = 'hgst109_maintenance_ac_detail';
    protected $primaryKey = 'id';
    protected $casts = ['id' => 'string' ];
 
    
     public function maintenance()
    {
    	return $this->belongsTo(hgst108_maintenance_ac::class, 'maintenance_ac_id');
    }

    public function unit()
    {
        return $this->belongsTo(hrdm101_unit::class, 'Unit_id');
    }
     

   
}

 