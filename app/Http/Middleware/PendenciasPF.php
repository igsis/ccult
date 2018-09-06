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
        if( isset(auth()->user()->endereco->cep) &&  auth()->user()->telefones->count() > 0 )

            return redirect()->route('pessoaFisica.home');

        return $next($request);
    }
}
