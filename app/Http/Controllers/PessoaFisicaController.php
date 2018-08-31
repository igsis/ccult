<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PessoaFisicaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:pessoaFisica');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pessoaFisicaAuth.home');
    }
}
