<?php

namespace App\Http\Controllers\PessoaJuridicaAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PessoaJuridicaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:pessoaJuridica');
    }

    public function index()
    {
        return view('pessoaJuridicaAuth.pessoaJuridica');
    }
}
