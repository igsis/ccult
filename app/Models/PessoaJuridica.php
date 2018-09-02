<?php

namespace ccult\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class PessoaJuridica extends Authenticatable
{
    use Notifiable;
  
    protected $guard = 'pessoaJuridica';

    protected $fillable = [
        'name', 'email', 'password',
        'nome_social',
        'nome_artistico',
        'documento_tipo_id',
        'rg_rne',
        'ccm',
        'cpf',
        'passaporte',
        'data_nascimento',
        'updated_at'
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
