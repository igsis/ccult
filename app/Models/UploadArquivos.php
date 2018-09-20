<?php

namespace ccult\Models;

use Illuminate\Database\Eloquent\Model;

class UploadArquivos extends Model
{
    protected $primaryKey = 'idUploadArquivo';

    public $timestamps = false;

    protected $fillable = [
        'idUploadArquivo', 
        'idTipo', 
        'idPessoa', 
        'idListaDocumento', 
        'arquivo', 
        'dataEnvio', 
        'publicado'
    ];

}