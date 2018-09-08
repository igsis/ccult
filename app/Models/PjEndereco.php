<?php

namespace ccult\Models;

use Illuminate\Database\Eloquent\Model;

class PjEndereco extends Model
{
    protected $primaryKey = 'pessoa_juridica_id';

    protected $fillable = [
        'pessoa_juridica_id',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'uf',
        'cep'
    ];
    
    public $timestamps = false;

    public function pessoaJuridica()
    {
    	return $this->belogsTo(PessoaJuridica::class);
    }
}
