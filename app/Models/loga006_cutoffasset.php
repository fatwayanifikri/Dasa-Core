<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class loga006_cutoffasset extends Model
{
    protected $table = 'loga006_cutoffasset';
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


}

