<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class logt302_purchaseorderdetail extends Model
{
    protected $table = 'logt302_purchaseorderdetail';
    protected $primaryKey = 'id';
    protected $casts = ['id' => 'string' ];
 


     public function purchaseorder()
    {
    	return $this->belongsTo(logt301_purchaseorder::class, 'purchaseorder_id');
    }

    public function purchasereq()
    {
        return $this->belongsTo(logt202_purchaserequestdetail::class, 'prdetail_id');
    }
     
   
}

 