<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cms_users extends Model
{
    protected $table = 'cms_users';
    protected $primaryKey = 'id';
    protected $fillable = ['id','nama','password'];
   
    public function jabatan()
    {
        return $this->belongsTo(cms_privileges::class, 'id_cms_privileges');
    }
   
}

 