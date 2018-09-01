<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class PessoaFisica extends Authenticatable
{
    use Notifiable;

    protected $guard = 'pessoaFisica';   

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
