<?php

namespace ccult\Models;

use Illuminate\Database\Eloquent\Model;

class PjEndereco extends Model
{
    protected $fillable = [
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
        'cep'
    ];
    
    public $timestamps = false;

    public function pessoaJuridica()
    {
    	return $this->belogsTo(PessoaJuridica::class);
    }
}
