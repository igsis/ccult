<?php

namespace ccult\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class MenuPessoaFisicaProvider extends ServiceProvider
{
    protected $policies = [
        'ccult\Model' => 'ccult\Policies\ModelPolicy',
    ];

    public function boot(Dispatcher $events)
    {
        $this->registerPolicies();

        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            # Menu para Pessoas Fisicas
            if(auth()->guard('pessoaFisica')->user())
            {              
                Gate::define('pendecias', function ($user) {

                    if(
                        (!$user->endereco) ||
                        (!$user->telefone)
                    ){
                        return $user;
                    }
                });

                $pf = auth()->user();
                
                # Count das Pendencias PF
                $count =  $pf->telefone ? 0 : 1;
                $count += $pf->endereco ? 0 : 1;


                $event->menu->add('MENU DE NAVEGAÇÃO');
                $event->menu->add(
                    [
                        'text'  =>   'Home',
                        'url'   =>    route('pessoaFisica.home'),
                        'icon'  =>   'home',
                    ],
                    [
                        'text'          => 'Pendências',
                        'icon_color'    => 'red',
                        'url'           =>  route('pessoaFisica.pendecias'),
                        'label'         =>  $count,
                        'label_color'   => 'danger',
                        'can'           => 'pendecias'
                    ],
                    [
                        'text' => 'Cadastro',                    
                        'icon' => 'user',
                        'submenu' => [
                            [
                                'text'  => 'Dados Princípais',
                                'icon'  => '',
                                'url'   => route('pessoaFisica.cadastro'),
                            ],            
                            [
                                'text'  => 'Endereço',
                                'icon'  => '',
                                'url'   =>  route('pessoaFisica.formEndereco'),                                
                            ],                                    
                            [
                                'text'  => 'Telefones',
                                'icon'  => '',
                                'url'   =>  route('pessoaFisica.formTelefones'),                                
                            ],
                        ],
                    ]
                    /*,
                    [
                        'text'  =>   'Documentos',
                        'url'   =>    "route('pessoaFisica.home')",
                        'icon'  =>   ' fa-cloud-upload',
                    ]
                    */
                );
            }
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
