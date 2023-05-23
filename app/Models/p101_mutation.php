<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class p101_mutation extends Model
{
    protected $table = 'p101_mutation';
    protected $primaryKey = 'id';
    protected $casts = ['id' => 'string' ];

    public function unit()
    {
    	return $this->belongsTo(hrdm101_unit::class, 'AsalUnit_id');
    }
    public function unit2()
    {
        return $this->belongsTo(hrdm101_unit::class, 'Unit_id');
    }
    public function employee()
    {
        return $this->belongsTo(hrde200_employee::class, 'Employee_id');
    }

    public function company()
    {
    	return $this->belongsTo(hrdm100_company::class, 'Company_id');
    }

    public function jabatan()
    {
    	return $this->belongsTo(cms_privileges::class, 'AsalPrivileges_id');
    }
    public function jabatan2()
    {
        return $this->belongsTo(cms_privileges::class, 'Privileges_id');
    }
}

