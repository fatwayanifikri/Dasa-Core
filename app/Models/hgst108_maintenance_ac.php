<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class hgst108_maintenance_ac extends Model
{
    protected $table = 'hgst108_maintenance_ac';
    protected $primaryKey = 'id';
    protected $casts = ['id' => 'string' ];
 
    
     public function unit()
    {
    	return $this->belongsTo(hrdm101_unit::class, 'Unit_id');
    }
     
    public function asset()
    {
    	return $this->belongsTo(loga001_asset::class, 'asset_id');
    }


   
}

 