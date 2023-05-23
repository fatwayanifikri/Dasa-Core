<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mkt004_faktur extends Model
{
    protected $table = 'mkt004_faktur';
    protected $primaryKey = 'id';
    protected $casts = ['id' => 'string' ];

    public function sales()
    {
        return $this->belongsTo(hrde200_employee::class, 'SalesID');
    }   

   
}

 