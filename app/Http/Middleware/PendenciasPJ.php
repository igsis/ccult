<?php

namespace ccult\Http\Middleware;

use Closure;

class PendenciasPJ
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

        if(auth()->user()->endereco && auth()->user()->telefone && auth()->user()->representante_legal1_id)

            return redirect()->route('pessoaJuridica.home');

        return $next($request);
    }
}
