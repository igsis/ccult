<?php

namespace ccult\Http\Controllers\PessoaFisicaAuth;

use ccult\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ccult\Models\PessoaFisica;
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
            'cpf' => 'required|min:14',
            'password' => 'required|min:6'
        ],
        [
            'required' => 'O campo :attribute é obrigatório',
        ], [
            'cpf'      => 'CPF',
            'password'  => 'Senha',
        ]);

        $credential = [
            'cpf' => $request->cpf,
            'password' => $request->password
        ];

        if ($request->get('user_check') == '' || $request->get('user_check') == null) {
            $checker = PessoaFisica::where("cpf",$request->cpf)->first(); 
            if ($checker) {
                if(Auth::guard('pessoaFisica')->attempt($credential, $request->menber)){
                    return redirect()->route('pessoaFisica.home');
                } else {
                    return $this->sendFailedLoginResponse($request);
                }    
            } else {
                return $this->sendFailedLoginResponse($request);
            }
        } 

        return redirect()->back()->withInput($request->only('cpf', 'remember'));
    }

    
}
