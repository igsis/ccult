<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
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
                $event->menu->add('Menu de Navegação');
                $event->menu->add([
                    'text' =>   'Home',
                    'url'  =>   route('home'),
                    'icon' =>   'home',
                ]);
            }
        });

        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            # Menu para Pessoas Fisicas
            if(auth()->guard('pessoaFisica')->user()){
               
                $event->menu->add('Menu de Navegação');
                $event->menu->add(
                    [
                        'text' =>   'Home',
                        'url'  =>   route('home'),
                        'icon' =>   'home',
              
                    ],
                    [
                        'text' => 'Pessoa Física',                    
                        'icon' => 'user',
                        'submenu' => [
                            [
                                'text'    => 'Cadastrar',
                                'icon' => '',
                                'url'  => 'PessoaJuridica/cadastrar',
                            ],
            
                            [
                                'text' => 'Atualizar',
                                'icon' => '',
                                'url'  => 'PessoaJuridica/Atualizar',
                            ],
                        ],
                    ]
                );

                // dd($event->menu);
            }
        });

        # Menu para Pessoas Fisicas
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            # Menu para Pessoas Fisicas
            if(auth()->guard('pessoaJuridica')->user())
            {
                $event->menu->add('Menu de Navegação');
                $event->menu->add(
                    [
                        'text' =>   'Home',
                        'url'  =>   route('home'),
                        'icon' =>   'home',
              
                    ],
                    [
                        'text' => 'Pessoa Jurídica',
                        'icon' => 'user',
                        'submenu' => [
                            [
                                'text'    => 'Cadastrar',
                                'icon' => '',
                                'url'  => 'PessoaJuridica/cadastrar',
                            ],
            
                            [
                                'text' => 'Atualizar',
                                'icon' => '',
                                'url'  => 'PessoaJuridica/Atualizar',
                            ],
                        ],
                    ]
                );

                // dd($event->menu);
            }
        });
    }
}
