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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    protected function showRegistrationForm()
    {
        return view('pessoaFisicaAuth.register');
    }

    protected function create(array $data)
    {
        return pessoaFisica::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
