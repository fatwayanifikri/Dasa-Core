<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cms_privileges extends Model
{
    protected $table = 'cms_privileges';
    protected $primaryKey = 'id';
    protected $casts = ['id' => 'string' ];
}
