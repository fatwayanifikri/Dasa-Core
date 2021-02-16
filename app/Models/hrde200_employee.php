<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class hrde200_employee extends Model
{
    protected $table = 'hrde200_employee';
    protected $primaryKey = 'id';
    protected $casts = ['id' => 'string' ];
}
