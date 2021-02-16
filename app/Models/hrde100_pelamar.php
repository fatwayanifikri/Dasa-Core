<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class hrde100_pelamar extends Model
{
    protected $table = 'hrde100_Pelamar';
    protected $primaryKey='id';
    protected $casts = ['id' => 'string' ];

    public function interview()
    {
        return $this->hasOne('App\Models\hrdt200_interview','Pelamar_id');
    }
    
}
