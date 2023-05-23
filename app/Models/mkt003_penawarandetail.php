<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mkt003_penawarandetail extends Model
{
    protected $table = 'mkt003_penawarandetail';
    protected $primaryKey = 'id';
    protected $casts = ['id' => 'string' ];

     public function penawaran()
    {
    	return $this->belongsTo(mkt002_penawaran::class, 'PenawaranID');
    }
   
    
    

   
}

 