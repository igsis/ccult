<?php

namespace ccult\Models;

use Illuminate\Database\Eloquent\Model;

class PfEndereco extends Model
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

    public function pessoaFisica()
    {
    	return $this->belogsTo(PessoaFisica::class);
    }
}