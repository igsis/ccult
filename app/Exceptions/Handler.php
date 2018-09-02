<?php

namespace ccult\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    public function render($request, Exception $exception)
    {
        $class = get_class($exception);

        switch($class) {
            case 'Illuminate\Auth\AuthenticationException':
                $guard = array_get($exception->guards(), 0);
                switch ($guard) {
                    case 'pessoaFisica':
                    $login = 'pessoaFisica.formLogin';
                        break;
                    case 'pessoaJuridica':
                        $login = 'pessoaJuridica.formLogin';
                            break;
                    default:
                        $login = 'login';
                        break;
                }
    
                return redirect()->route($login);
        }
    
        return parent::render($request, $exception);     
    }
}
