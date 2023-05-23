<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class t200_stockcuti extends Model
{
    protected $table = 't200_stockcuti';
    protected $primaryKey = 'id';
    protected $casts = ['id' => 'string' ];

     public function employee()
    {
    	return $this->belongsTo(hrde200_employee::class, 'Employee_id');
    }
   
    
    

   
}

 