<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class logt201_purchaserequest extends Model
{
    protected $table = 'logt201_purchaserequest';
    protected $primaryKey = 'id';
    protected $casts = ['id' => 'string' ];

     public function unit()
    {
        return $this->belongsTo(hrdm101_unit::class, 'UnitID');
    }
   
}

 