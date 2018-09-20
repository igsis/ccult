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
        'upload_arquivo_id',
        'active',
        'created_at',
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

    public function endereco()
    {
        return $this->hasOne(PjEndereco::class);
    }

    public function telefone()
    {
        return $this->hasOne(PjTelefone::class);
    }

    public function representanteLegal1()
    {
        return $this->belongsTo(RepresentanteLegal::class, 'representante_legal1_id');
    }

    public function representanteLegal2()
    {
        return $this->belongsTo(RepresentanteLegal::class, 'representante_legal2_id');
    }
}
