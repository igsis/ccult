<?php

namespace ccult\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{

    protected $namespace = 'ccult\Http\Controllers';

    public function boot()
    {

        parent::boot();
    }

    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

    }


    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));

        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/UserRoute.php'));

        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/PessoaFisicaRoute.php'));

        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/PessoaJuridicaRoute.php'));
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/UploadsPF.php'));
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/UploadsPJ.php'));             
    }


    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
