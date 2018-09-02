<?php

namespace ccult\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class PessoaFisica extends Authenticatable
{
    use Notifiable;

    protected $guard = 'pessoaFisica';   

    protected $fillable = [
        'nome', 
        'email', 
        'password', 
        'nome_social',
        'nome_artistico',
        'nome_artistico',
        'documento_tipo_id',
        'rg_rne',
        'ccm', 
        'cpf',
        'passaporte',
        'data_nascimento',
        'updated_at'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function endereco()
    {
        return $this->hasOne(PfEndereco::class);
    }

    public function telefones()
    {
        return $this->hasMany(PfTelefone::class);
    }
}
