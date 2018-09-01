<?php

namespace App\Http\Controllers\PessoaJuridicaAuth;

use App\Models\PessoaJuridica;
use App\Http\Controllers\Controller;
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
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
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
