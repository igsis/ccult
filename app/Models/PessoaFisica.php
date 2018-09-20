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
        'nome_social',
        'nome_artistico',
        'upload_arquivo_id',
        'rg_rne',
        'ccm',
        'cpf',
        'passaporte',
        'data_nascimento',
        'email',
        'password',
        'active',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function endereco()
    {
        return $this->hasOne(PfEndereco::class);
    }

    public function telefone()
    {
        return $this->hasOne(PfTelefone::class);
    }
}
