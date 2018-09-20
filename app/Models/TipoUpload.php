<?php

namespace ccult\Models;

use Illuminate\Database\Eloquent\Model;

class TipoUpload extends Model
{
    protected $table = 'tipo_upload';

    protected $primaryKey = 'idTipoUpload';

    public $timestamps = false;

    protected $fillable = [
        'idTipoUpload',
        'tipo', 
    ];

}