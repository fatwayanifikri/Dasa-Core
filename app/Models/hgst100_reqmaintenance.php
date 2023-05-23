<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class hgst100_reqmaintenance extends Model
{
    protected $table = 'hgst100_reqmaintenance';
    protected $primaryKey = 'id';
    protected $casts = ['id' => 'string' ];

    public function unit()
    {
    	return $this->belongsTo(hrdm101_unit::class, 'Unit_id');
    }

 public function detail()
    {
        return $this->belongsTo(hgst101_reqmaintenancedetail::class, 'id');
    }
   
    
}

