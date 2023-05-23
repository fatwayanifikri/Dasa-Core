<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class loga001_asset extends Model
{
    protected $table = 'loga001_asset';
    protected $primaryKey = 'id';
    protected $casts = ['id' => 'string' ];

    public function kategori()
    {
    	return $this->belongsTo(loga003_kategoriasset::class, 'kategori_id');
    }

     public function unit()
    {
        return $this->belongsTo(hrdm101_unit::class, 'Unit_id');
    }

    public function riwayat()
    {
        return $this->belongsTo(loga002_riwayatasset::class, 'kode');
    }




}

