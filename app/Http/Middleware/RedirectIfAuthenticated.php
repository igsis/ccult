<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard) {
            case 'pessoaFisica':
                if(Auth::guard($guard)->check()){
                    return redirect()->route('pessoaFisica.home');
                }
                break;
            case 'pessoaJuridica':
                if(Auth::guard($guard)->check()){
                    return redirect()->route('pessoaJuridica.home');
                }
                break;
            
            default:
                if (Auth::guard($guard)->check()) {
                    return redirect('/home');
                }
                break;
        }

        return $next($request);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        // return $request->expectsJson()
        //             ? response()->json(['message' => $exception->getMessage()], 401)
        //             : redirect()->guest(route('login'));
        if($request->expectsJson()) {
                return response()->json(['message' =>  $exception->getMessage()],401);
            }
        $guard = array_get($exception->guards(), 0);
        switch ($guard) {
            case 'pessoaFisica':
                $login = 'pessoaFisica.login';
                break;

            case 'pessoaJuridica':
                $login = 'pessoaJuridica.login';
                break;
            
            default:
                $login = 'login';
                break;
        }

        return redirect()->guest(route($login));
    }
}
