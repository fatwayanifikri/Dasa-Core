<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class hrde200_employee extends Model
{
    protected $table = 'hrde200_employee';
    protected $primaryKey = 'id';
    protected $casts = ['id' => 'string' ];
    protected $fillable = ['NPK','EmployeeName','Jabatan_id','Unit_id'];

    public function unit()
    {
    	return $this->belongsTo(hrdm101_unit::class, 'Unit_id');
    }

    public function company()
    {
    	return $this->belongsTo(hrdm100_company::class, 'Company_id');
    }

    public function department()
    {
    	return $this->belongsTo(hrdm102_departement::class, 'Departement_id');
    }

    public function jabatan()
    {
    	return $this->belongsTo(cms_privileges::class, 'Jabatan_id');
    }
}

