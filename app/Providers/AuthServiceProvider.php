<?php

namespace ccult\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;


class AuthServiceProvider extends ServiceProvider
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
            # Menu para Users
            if(auth()->guard('web')->user())
            {
                $event->menu->add('MENU DE NAVEGAÇÃO');
                $event->menu->add([
                    'text' =>   'Home',
                    'url'  =>   route('home'),
                    'icon' =>   'home',
                ]);
            }
        });

        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            # Menu para Pessoas Fisicas

            // Gate::define('validar', function ($user) {
            //     return $user;
            // });
            if(auth()->guard('pessoaFisica')->user())
            {              
                $event->menu->add('MENU DE NAVEGAÇÃO');
                $event->menu->add(
                    [
                        'text' =>   'Home',
                        'url'  =>   route('pessoaFisica.home'),
                        'icon' =>   'home',
                    ],
                    [
                        'text' =>   'Home',
                        'url'  =>   route('pessoaFisica.home'),
                        'icon' =>   'home',
                        'can' => 'validar'
                    ],
                    [
                        'text' => 'Pessoa Física',                    
                        'icon' => 'user',
                        'submenu' => [
                            [
                                'text'    => 'Cadastro',
                                'icon' => '',
                                'url'  => route('pessoaFisica.formRegister'),
                            ],
            
                            [
                                'text' => 'Atualizar',
                                'icon' => '',
                                'url'  => 'ASD',
                            ],
                        ],
                    ]
                );
            }

        });

        # Menu para Pessoas Fisicas
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            # Menu para Pessoas Fisicas
            if(auth()->guard('pessoaJuridica')->user())
            {
                $event->menu->add('MENU DE NAVEGAÇÃO');
                $event->menu->add(
                    [
                        'text' =>   'Home',
                        'url'  =>   route('pessoaJuridica.home'),
                        'icon' =>   'home',
              
                    ],
                    [
                        'text' => 'Pessoa Jurídica',
                        'icon' => 'user',
                        'submenu' => [
                            [
                                'text'    => 'Cadastro',
                                'icon' => '',
                                'url'  => 'ASD',
                            ],
            
                            [
                                'text' => 'Atualizar',
                                'icon' => '',
                                'url'  => 'ASD',
                            ],
                        ],
                    ]
                );
            }
        });
    }
}
