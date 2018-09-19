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

        if (request()->get('cpf'))
        {
            return 'cpf';
        }

        if (request()->get('passaporte'))
        {
            return 'passaporte';
        }

        return 'cpf';

    }
  
    public function showLoginForm()
    {
        return view('pessoaFisicaAuth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request,[
            'cpf' => 'required_without:passaporte',
            'passaporte' => 'required_without:cpf',
            'password' => 'required|min:6'
        ],
        [
            'required' => 'O campo :attribute é obrigatório',
        ], [
            'cpf'      => 'CPF',
            'password'  => 'Senha',
        ]);
        
        if ($request->cpf)
        {
            $credential = [
                'cpf'       =>  $request->cpf,
                'password'  =>  $request->password
            ];
        }elseif ($request->passaporte)
        {
            $credential = [
                'passaporte'    =>  $request->passaporte,
                'password'      =>  $request->password
            ];
        }

        if ($request->get('user_check') == '' || $request->get('user_check') == null) {

            $checker = PessoaFisica::where("cpf", $request->cpf)->first(); 

            $checker2 = PessoaFisica::where("passaporte", $request->passaporte)->first(); 

            if ($checker) {
                if(Auth::guard('pessoaFisica')->attempt($credential, $request->menber)){
                    return redirect()->route('pessoaFisica.home');
                } else {
                    return $this->sendFailedLoginResponse($request);
                }    
            }
            elseif ($checker2) {
                if(Auth::guard('pessoaFisica')->attempt($credential, $request->menber)){
                    return redirect()->route('pessoaFisica.home');
                } else {
                    return $this->sendFailedLoginResponse($request);
                    
                }    
            }
            else {
                return $this->sendFailedLoginResponse($request);
            }
        } 

        return redirect()->back()->withInput($request->only('cpf', 'remember'));
    }

    
}
