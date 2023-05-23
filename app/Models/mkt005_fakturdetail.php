<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mkt005_fakturdetail extends Model
{
    protected $table = 'mkt005_fakturdetail';
    protected $primaryKey = 'id';
    protected $casts = ['id' => 'string' ];

     public function penawaran()
    {
    	return $this->belongsTo(mkt002_penawaran::class, 'PenawaranID');
    }
   
    
    

   
}

 