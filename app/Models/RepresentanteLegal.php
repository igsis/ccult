<?php

namespace ccult\Models;

use Illuminate\Database\Eloquent\Model;

class RepresentanteLegal extends Model
{ 
	protected $table = 'representante_legais';
	protected $fillable = [
		'nome',
		'rg', 
		'cpf', 
	];

	public $timestamps = false;

  	public function pessoaJuridica()
    {
    	return $this->hasMany(PessoaJuridica::class);
    }	
}
