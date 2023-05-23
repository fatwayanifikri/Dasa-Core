<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class hgst101_reqmaintenancedetail extends Model
{
    protected $table = 'hgst101_reqmaintenancedetail';
    protected $primaryKey = 'id';
    protected $casts = ['id' => 'string' ];

    public function reqid()
    {
    	return $this->belongsTo(hgst100_reqmaintenance::class, 'requestmaintenance_id');
    }


    public function kategori()
    {
    	return $this->belongsTo(hgst102_reqmaintenancekategori::class, 'kategori');
    }

    
}

