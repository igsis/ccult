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


            if(auth()->guard('pessoaFisica')->user())
            {              
                Gate::define('pendecias', function ($user) {

                    if((!isset($user->endereco->cep) || (!$user->telefones->count() > 0))){
                        return $user;
                    }
                });


                $event->menu->add('MENU DE NAVEGAÇÃO');
                $event->menu->add(
                    [
                        'text' =>   'Home',
                        'url'  =>   route('pessoaFisica.home'),
                        'icon' =>   'home',
                    ],
                    [
                        'text'       => 'Pendências',
                        'icon_color' => 'red',
                        'url'        => 'asd',
                        'can'        => 'pendecias'
                    ],
                    [
                        'text' => 'Cadastro',                    
                        'icon' => 'user',
                        'submenu' => [
                            [
                                'text'    => 'Dados Princípais',
                                'icon' => '',
                                'url'  => route('pessoaFisica.cadastro'),
                            ],            
                            [
                                'text' => 'Endereço',
                                'icon' => '',
                                'url'  => route('pessoaFisica.formEndereco'),                                
                            ],                                    
                            [
                                'text' => 'Telefones',
                                'icon' => '',
                                'url'  => route('pessoaFisica.formTelefones'),                                
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
