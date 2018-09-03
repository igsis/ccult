<?php

namespace ccult\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class PessoaJuridica extends Authenticatable
{
    use Notifiable;
  
    protected $guard = 'pessoaJuridica';

    protected $fillable = [
        'razao_social',
        'cnpj',
        'ccm',
        'email',
        'password',
        'representante_legal1_id',
        'representante_legal2_id',
        'active',
        'created_at',
        'updated_at'
        // documento_tipo_id ??
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function endereco()
    {
        return $this->hasOne(PjEndereco::class);
    }

    public function telefones()
    {
        return $this->hasMany(PjTelefone::class);
    }
}
