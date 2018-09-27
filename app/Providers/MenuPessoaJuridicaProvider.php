<?php

namespace ccult\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class MenuPessoaJuridicaProvider extends ServiceProvider
{
    protected $policies = [
        'ccult\Model' => 'ccult\Policies\ModelPolicy',
    ];

    public function boot(Dispatcher $events)
    {
        $this->registerPolicies();

        # Menu para Pessoas Jurídica
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            # Menu para Pessoas Jurídica
            if(auth()->guard('pessoaJuridica')->user())
            {              
                Gate::define('pendecias', function ($user) {

                    if(
                        (!$user->endereco) || // Se não tiver Endereco
                        (!$user->telefone) || // Se não tiver Telefone
                        (!$user->representanteLegal1) // Se não tiver pelo menos o 1º rep legal
                     ){
                        return $user;
                    }
                });

                $pj = auth()->user();

                # Count das Pendencias PJ
                $count =  $pj->telefone ? 0 : 1;
                $count += $pj->endereco ? 0 : 1;
                $count += $pj->representanteLegal1 ? 0 : 1;
              

                $event->menu->add('MENU DE NAVEGAÇÃO');
                $event->menu->add(
                    [
                        'text' =>   'Home',
                        'url'  =>    route('pessoaJuridica.home'),
                        'icon' =>   'home',
                    ],
                    [
                        'text'          => 'Pendências',
                        'icon_color'    => 'red',
                        'url'           =>  route('pessoaJuridica.pendecias'),
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
                                'url'   => route('pessoaJuridica.cadastro'),
                            ],            
                            [
                                'text'  => 'Endereço',
                                'icon'  => '',
                                'url'   => route('pessoaJuridica.formEndereco'),                                
                            ],                                    
                            [
                                'text'  => 'Telefones',
                                'icon'  => '',
                                'url'   => route('pessoaJuridica.formTelefones'),                                
                            ],
                        ],
                    ],
                    [
                        'text' => 'Representante Legal',                    
                        'icon' => 'user',
                        'submenu' => [
                            [
                                'text'  => '1º Representante Legal',
                                'icon'  => '',
                                'url'   => route('pessoaJuridica.formRepresentante'),
                            ],            
                            [
                                'text'  => '2º Representante Legal',
                                'icon'  => '',
                                'url'   => route('pessoaJuridica.formRepresentante2'),                                
                            ],
                        ],
                    ],
                    [
                        'text'  =>   'Documentos',
                        'url'   =>    route('pessoaJuridica.upload.listar'),
                        'icon'  =>   ' fa-cloud-upload',
                    ]
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
