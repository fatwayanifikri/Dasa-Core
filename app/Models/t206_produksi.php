<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class t206_produksi extends Model
{
    protected $table = 't206_produksi';
    protected $primaryKey = 'id';
    protected $casts = ['id' => 'string' ];

    public function mesin()
    {
        return $this->belongsTo(t207_mesinproduksi::class, 'id_mesin');
    }   

    public function unit()
    {
        return $this->belongsTo(hrdm101_unit::class, 'lokasi_produksi');
    }



   
}

 