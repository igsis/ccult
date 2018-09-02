<?php

namespace ccult\Http\Controllers;

use Illuminate\Http\Request;

class PessoaJuridicaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:pessoaJuridica');
    }

    public function index()
    {
        return view('pessoaJuridicaAuth.home');
    }
}
