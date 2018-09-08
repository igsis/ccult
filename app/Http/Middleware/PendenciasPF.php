<?php

namespace ccult\Http\Middleware;

use Closure;
use Auth;

class PendenciasPF
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if( auth()->user()->endereco &&  auth()->user()->telefone)

            return redirect()->route('pessoaFisica.home');

        return $next($request);
    }
}
