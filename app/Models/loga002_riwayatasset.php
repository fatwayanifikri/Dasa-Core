<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class loga002_riwayatasset extends Model
{
    protected $table = 'loga002_riwayatasset';
    protected $primaryKey = 'id';
    protected $casts = ['id' => 'string' ];

    public function unit()
    {
    	return $this->belongsTo(hrdm101_unit::class, 'Unit_id');
    }

    public function aset()
    {
        return $this->belongsTo(loga001_asset::class, 'asset_id');
    }


}

