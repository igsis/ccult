<?php

namespace ccult\Models;

use Illuminate\Database\Eloquent\Model;

class PjTelefone extends Model
{
    protected $fillable = [
    	'telefone',
    	'publicado'
    ];

    public $timestamps = false;

    public function pessoaJuridica()
    {
    	return $this->belogsTo(PessoaJuridica::class);
    }
}
