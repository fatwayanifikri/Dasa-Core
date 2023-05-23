<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class logt202_purchaserequestdetail extends Model
{
    protected $table = 'logt202_purchaserequestdetail';
    protected $primaryKey = 'id';
    protected $casts = ['id' => 'string' ];
 


     public function request()
    {
    	return $this->belongsTo(logt201_purchaserequest::class, 'PR_id');
    }

     
   
}

 