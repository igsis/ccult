<?php

namespace ccult\Models;

use Illuminate\Database\Eloquent\Model;

class UploadArquivos extends Model
{
    protected $primaryKey = 'idUploadArquivo';

    public $timestamps = false;

    protected $fillable = [
        'idUploadArquivo',  
        'idPessoa', 
        'idListaDocumento', 
        'arquivo', 
        'data_envio', 
        'publicado'
    ];

}