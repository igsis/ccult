<?php

namespace ccult\Http\Controllers\PessoaFisicaAuth;

use ccult\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/PessoaFisica/home';

    public function __construct()
    {
        $this->middleware('guest:pessoaFisica')->except('logout');
    }

    public function username()
    {
        return 'cpf';
    }
  
    public function showLoginForm()
    {
        return view('pessoaFisicaAuth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request,[
            'cpf' => 'required|min:11',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ],
        [
            'required' => 'O campo :attribute é obrigatório',
        ], [
            'cpf'      => 'CPF',
            'email'     => 'E-mail',
            'password'  => 'Senha',
        ]);
        
        $credential = [
            'cpf' => $request->email,
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::guard('pessoaFisica')->attempt($credential, $request->menber)){
            return redirect()->route('pessoaFisica.home');
        }

        // if(Auth::guard('web')->attempt($credential, $request->menber)){
        //     return redirect()->route('home');
        // }

        return redirect()->back()->withInput($request->only('email', 'cpf', 'remember'));
    }

    
}
