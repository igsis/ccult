<?php

namespace ccult\Http\Controllers\PessoaJuridicaAuth;

use ccult\Models\PessoaJuridica;
use ccult\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/PessoaJuridica/home';

    public function __construct()
    {
        $this->middleware('guest:pessoaJuridica');
    }

    public function guard()
    {
        return auth()->guard('pessoaJuridica');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'razao_social' => 'required|string|max:255',
            'cnpj' => 'required|min:10|unique:pessoa_juridicas',
            'email' => 'required|string|email|max:255|unique:pessoa_juridicas',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    protected function showRegistrationForm()
    {
        return view('pessoaJuridicaAuth.register');
    }


    protected function create(array $data)
    {
        return pessoaJuridica::create([
            'razao_social' => $data['razao_social'],
            'cnpj' => $data['cnpj'],
            'email' => $data['email'],            
            'password' => Hash::make($data['password']),
        ]);
    }
}
