<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class logt303_copypurchaserequest extends Model
{
    protected $table = 'logt303_copypurchaserequest';
    protected $primaryKey = 'id';
    protected $casts = ['id' => 'string' ];
 


     public function purchaseorder()
    {
    	return $this->belongsTo(logt301_purchaseorder::class, 'purchaseorder_id');
    }

    public function unit()
    {
        return $this->belongsTo(hrdm101_unit::class, 'Unit_id');
    }
     
   
}

 