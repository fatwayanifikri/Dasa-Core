<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mkt002_penawaran extends Model
{
    protected $table = 'mkt002_penawaran';
    protected $primaryKey = 'id';
    protected $casts = ['id' => 'string' ];

    public function sales()
    {
        return $this->belongsTo(hrde200_employee::class, 'SalesID');
    }   

    public function unit()
    {
        return $this->belongsTo(hrdm101_unit::class, 'Sales_Unit');
    }

   
}

 