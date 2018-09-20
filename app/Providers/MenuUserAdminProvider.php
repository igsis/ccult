<?php

namespace ccult\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class MenuUserAdminProvider extends ServiceProvider
{
    protected $policies = [
        'ccult\Model' => 'ccult\Policies\ModelPolicy',
    ];

    public function boot(Dispatcher $events)
    {
        $this->registerPolicies();

        Gate::define('users', function ($user) {
            return $user;
        });

        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            if(auth()->guard('web')->user())
            {
                $event->menu->add('MENU DE NAVEGAÇÃO');
                $event->menu->add([
                    'text'  => 'Home',
                    'url'   =>  route('home'),
                    'icon'  => 'home',
                ]);
            }
        });
    }

    public function register()
    {
        
    }
}
