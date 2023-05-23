<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mkt001_customer extends Model
{
    protected $table = 'mkt001_customer';
    protected $primaryKey = 'id';
    protected $casts = ['id' => 'string' ];
 


     public function unit()
    {
    	return $this->belongsTo(hrdm101_unit::class, 'StoreID');
    }
     
   
}

 