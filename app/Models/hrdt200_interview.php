<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class hrdt200_interview extends Model
{
    protected $table = 'hrde100_Pelamar';
    protected $primaryKey='id';
    protected $casts = ['id' => 'string'];

    public function Pelamar()
    {
        return $this->belongsTo('App\Models\hrde100_pelamar');
    }
}
