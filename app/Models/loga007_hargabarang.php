<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class loga007_hargabarang extends Model
{
    protected $table = 'loga007_hargabarang';
    protected $primaryKey = 'id';
    protected $casts = ['id' => 'string' ];


    public function unit()
    {
        return $this->belongsTo(hrdm101_unit::class, 'Sales_Unit');
    }

   
}

 