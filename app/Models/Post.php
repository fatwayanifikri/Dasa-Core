<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 't202_absensi';
    protected $fillable = ['EmployeeName'];
}