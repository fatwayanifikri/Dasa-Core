<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class hgst104_permintaanbbm extends Model
{
    protected $table = 'hgst104_permintaanbbm';
    protected $primaryKey = 'id';
    protected $casts = ['id' => 'string' ];

    public function kendaraan()
    {
    	return $this->belongsTo(hgst103_kendaraan::class, 'id_kendaraan');
    }

     public function jabatan()
    {
        return $this->belongsTo(cms_privileges::class, 'Jabatan_id');
    }

    public function unit()
    {
        return $this->belongsTo(hrdm101_unit::class, 'Unit_id');
    }

  


}

