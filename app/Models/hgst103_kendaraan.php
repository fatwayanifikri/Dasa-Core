<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class hgst103_kendaraan extends Model
{
    protected $table = 'hgst103_kendaraan';
    protected $primaryKey = 'id';
    protected $casts = ['id' => 'string' ];

   

     public function unit()
    {
        return $this->belongsTo(hrdm101_unit::class, 'Unit_id');
    }

    public function employee()
    {
        return $this->belongsTo(hrde200_employee::class, 'Employee_id');
    }

    public function jabatan()
    {
        return $this->belongsTo(cms_privileges::class, 'Jabatan_id');
    }

    public function bbm()
    {
        return $this->belongsTo(hgst105_bbm::class, 'jenis_bbm');
    }




}

