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

    public function jabatan()
    {
        return $this->belongsTo(cms_privileges::class, 'Jabatan_id');
    }
     public function nikah()
    {
        return $this->belongsTo(hrdm105_statusnikah::class, 'StatusNikah_id');
    }
    
}
