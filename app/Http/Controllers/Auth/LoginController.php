<?php

namespace ccult\Http\Controllers\Auth;

use ccult\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ccult\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validate($request,[

            'email' => 'sometimes|required|email',
            'password' => 'required|min:6'
        ], 
        [
            'required' => 'O campo :attribute é obrigatório',
        ], [
            'email'     => 'E-mail',
            'password'  => 'Senha',
        ]); 
        
        $credential = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if ($request->get('user_check') == '' || $request->get('user_check') == null) {
            $checker = user::where("email",$request->email)->first(); 
            if ($checker) {
                if(Auth::guard('web')->attempt($credential, $request->menber)){
                    return redirect()->route('home');
                } else {
                    return $this->sendFailedLoginResponse($request);
                }    
            } else {
                return $this->sendFailedLoginResponse($request);
            }
        } 

        return redirect()->back()->withInput($request->only('email', 'remember'));
    }
}
