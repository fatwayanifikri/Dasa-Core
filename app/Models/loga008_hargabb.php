<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class loga008_hargabb extends Model
{
    protected $table = 'loga008_hargabb';
    protected $primaryKey = 'id';
    protected $casts = ['id' => 'string' ];

     public function harga()
    {
    	return $this->belongsTo(loga007_hargabarang::class, 'barang_id');
    }
   
    
    

   
}

 