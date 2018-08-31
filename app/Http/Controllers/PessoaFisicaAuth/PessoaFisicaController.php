<?php

namespace App\Http\Controllers\PessoaFisicaAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PessoaFisicaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:pessoaFisica');
    }

    public function index()
    {
        return view('pessoaFisicaAuth.pessoaFisica');
    }

}
