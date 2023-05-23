<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrintGS extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hgst101_reqmaintenancedetail';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['tgl_request','UnitName','defect','kategori','lokasi'];
    


}
