<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class t112_absenlembur extends Model
{
    protected $table = 't112_absenlembur';
    protected $primaryKey = 'id';
    protected $casts = ['id' => 'string' ];

     public function employee()
    {
    	return $this->belongsTo(hrde200_employee::class, 'Employee_id');
    }
     public function employee2()
    {
    	return $this->belongsTo(hrde200_employee::class, 'EmployeeName');
    }
     public function unit()
    {
    	return $this->belongsTo(hrdm101_unit::class, 'Unit_id');
    }
     
     public function departement()
    {
    	return $this->belongsTo(hrdm102_departement::class, 'Departement_id');
    } 
    public function company()
    {
    	return $this->belongsTo(hrdm100_company::class, 'Company_id');
    }
    public function jabatan()
    {
    	return $this->belongsTo(cms_privileges::class, 'Jabatan_id');
    }
    public function voucher()
    {
        return $this->belongsTo(t113_keteranganstatusvoucher::class, 'isVoucher');
    }


   
}

 