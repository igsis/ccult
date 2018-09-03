<?php

namespace ccult\Models;

use Illuminate\Database\Eloquent\Model;

class PfEndereco extends Model
{
    protected $fillable = [
        'pessoa_fisica_id',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'uf',
        'cep',
    ];
    
    public $timestamps = false;

    public function pessoaFisica()
    {
    	return $this->belogsTo(PessoaFisica::class);
    }
}