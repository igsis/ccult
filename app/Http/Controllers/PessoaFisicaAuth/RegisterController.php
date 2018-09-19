<?php

namespace ccult\Http\Controllers\PessoaFisicaAuth;

use ccult\Models\PessoaFisica;
use ccult\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = '/PessoaFisica/home';

    public function __construct()
    {
        $this->middleware('guest:pessoaFisica');
    }

    public function guard()
    {
        return auth()->guard('pessoaFisica');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pessoa_fisicas',
            'password' => 'required|string|min:6|confirmed',
            'cpf' => 'required|min:14|cpf|unique:pessoa_fisicas',
            'passaporte' => 'nullable',
            'rg_rne' => 'required|string|min:6',
            'data_nascimento'  => 'required',
        ],
        [
            'required' => 'O campo :attribute é obrigatório',
        ], 
        [
            'nome'              => 'Nome',
            'email'             => 'E-mail',
            'password'          => 'Senha',
            'cpf'               => 'CPF',
            'passaporte'        => 'Passaporte',
            'rg_rne'            => 'RG - RNE',
            'data_nascimento'   => 'Data de Nascimento',
        ]);
    }

    protected function showRegistrationForm()
    {
        return view('pessoaFisicaAuth.register');
    }

    protected function create(array $data)
    {
        return pessoaFisica::create([
            'nome' => $data['nome'],
            'email' => $data['email'],
            'cpf' => $data['cpf'],
            'passaporte' => $data['passaporte'],
            'rg_rne' => $data['rg_rne'],
            'data_nascimento' => $data['data_nascimento'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
