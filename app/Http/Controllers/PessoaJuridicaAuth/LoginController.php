<?php

namespace ccult\Http\Controllers\PessoaJuridicaAuth;

use ccult\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/PessoaJuridica/home';

    public function __construct()
    {
        $this->middleware('guest:pessoaJuridica')->except('logout');
    }

    public function username()
    {
        return 'cnpj';
    }

    public function showLoginForm()
    {
        return view('pessoaJuridicaAuth.login'); 
    }

    public function login(Request $request)
    {
        $this->validate($request,[
            // 'email' => 'required|email',
            'cnpj' => 'required|min:6',
            'password' => 'required|min:6'
        ]);
        $credential = [
            'cnpj' => $request->cnpj,
            'password' => $request->password
        ];

        if(Auth::guard('pessoaJuridica')->attempt($credential, $request->menber)){
            return redirect()->route('pessoaJuridica.home');
        }

        if(Auth::guard('web')->attempt($credential, $request->menber)){
            return redirect()->route('home');
        }

        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

}
