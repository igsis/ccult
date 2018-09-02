<?php

namespace ccult\Http\Controllers\PessoaJuridicaAuth;

use ccult\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;
    
    public function __construct()
    {
        $this->middleware('guest:pessoaJuridica');
    }
}
