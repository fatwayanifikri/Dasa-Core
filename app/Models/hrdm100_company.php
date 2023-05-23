<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class hrdm100_company extends Model
{
    protected $table = 'hrdm100_company';
    protected $primaryKey = 'id';
    protected $casts = ['id' => 'string' ];
}
