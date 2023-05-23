<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class t208_detailproduksi extends Model
{
    protected $table = 't208_detailproduksi';
    protected $primaryKey = 'id';
    protected $casts = ['id' => 'string' ];

    public function mesin()
    {
        return $this->belongsTo(t207_mesinproduksi::class, 'mesin_id');
    }   

    public function unit()
    {
        return $this->belongsTo(hrdm101_unit::class, 'Unit_id');
    }

    public function produksi()
    {
        return $this->belongsTo(t206_produksi::class, 'produksi_id');
    }


   
}

 