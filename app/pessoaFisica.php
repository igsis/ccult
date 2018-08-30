<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class pessoaFisica extends Authenticatable
{
    protected $guard = 'pessoaFisica';

    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 
        'nome_social',
        'nome_artistico',
        'nome_artistico',
        'documento_tipo_id',
        'rg_rne',
        'ccm', 
        'cpf',
        'passaporte',
        'data_nascimento',
        'email'
    ];



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
