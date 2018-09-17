<?php

Route::group(['prefix' => 'PessoaJuridica', 'middleware' => 'pessoaJuridica'], function(){

    Route::get('/home', 'PessoaJuridicaController@index')->name('pessoaJuridica.home');
    
    // Rotas de Pessoa Jurídica Cadastro 

    Route::get('/cadastro' , 'PessoaJuridicaController@show')->name('pessoaJuridica.cadastro');

    Route::post('/atualizar' , 'PessoaJuridicaController@update')->name('pessoaJuridica.atualizar');

    // Rota de Pendências
    
    Route::get('Pendecias', 'PessoaJuridicaController@pendencias')->name('pessoaJuridica.pendecias')->middleware('PendenciasPJ');

    // Rotas de Endereço

    Route::get('/endereco' , 'PessoaJuridicaController@endereco')->name('pessoaJuridica.formEndereco');

    Route::post('/cadastroEndereco' , 'PessoaJuridicaController@cadastroEndereco')->name('pessoaJuridica.cadastroEndereco');

    Route::post('/atualizarEndereco' , 'PessoaJuridicaController@atualizarEndereco')->name('pessoaJuridica.atualizarEndereco');

    // Rotas de telefones 

    Route::get('/telefones' , 'PessoaJuridicaController@formTelefones')->name('pessoaJuridica.formTelefones');

    Route::post('/cadastroTelefone' , 'PessoaJuridicaController@cadastroTelefone')->name('pessoaJuridica.cadastroTelefone');

    Route::post('/atualizaTelefone' , 'PessoaJuridicaController@atualizaTelefone')->name('pessoaJuridica.atualizaTelefone');

    // Rotas de Representante Legal 1 e 2 Separar  

    Route::get('/RepresentanteLegal-1' , 'PessoaJuridicaController@formRepresentante')->name('pessoaJuridica.formRepresentante');

    Route::post('/CadastroRepresentanteLegal-1' , 'PessoaJuridicaController@cadastroRepresentante')->name('pessoaJuridica.cadastroRepresentante');

    Route::post('/EditarRepresentanteLegal-1' , 'PessoaJuridicaController@editarRepresentante')->name('pessoaJuridica.editarRepresentante');

    Route::get('/RepresentanteLegal-2' , 'PessoaJuridicaController@formRepresentante2')->name('pessoaJuridica.formRepresentante2');

    Route::post('/CadastroRepresentanteLegal-2' , 'PessoaJuridicaController@cadastroRepresentante2')->name('pessoaJuridica.cadastroRepresentante2');

    Route::post('/EditarRepresentanteLegal-2' , 'PessoaJuridicaController@editarRepresentante2')->name('pessoaJuridica.editarRepresentante2');

    Route::post('/RemoverRepresentanteLegal-1' , 'PessoaJuridicaController@removerRepresentante')->name('pessoaJuridica.removerRepresentante');

    Route::post('/RemoverRepresentanteLegal-2' , 'PessoaJuridicaController@removerRepresentante2')->name('pessoaJuridica.removerRepresentante2');

    Route::get('/PesquisarRepresentanteLegal' , 'PessoaJuridicaController@formRepresentante')->name('pessoaJuridica.viewPesquisaRep');

    Route::get('/PesquisarRepresentanteLegal-2' , 'PessoaJuridicaController@formRepresentante2')->name('pessoaJuridica.viewPesquisaRep2');

    Route::post('/PesquisarRepresentanteLegal' , 'PessoaJuridicaController@search')->name('pessoaJuridica.search');

    Route::post('/PesquisarRepresentanteLegal-2' , 'PessoaJuridicaController@search2')->name('pessoaJuridica.search2');

    Route::post('/VincularRepresentanteLegal-1' , 'PessoaJuridicaController@vincularRepresentante')->name('pessoaJuridica.vincularRepresentante');

    Route::post('/VincularRepresentanteLegal-2' , 'PessoaJuridicaController@vincularRepresentante2')->name('pessoaJuridica.vincularRepresentante2');

    Route::get('/VincularRepresentante',  'PessoaJuridicaController@formVincularRepresentante')->name('pessoaJuridica.formVincularRepresentante');

    Route::get('CadastrarRepresentante',  'PessoaJuridicaController@formCadastrarRepresentante')->name('pessoaJuridica.formCadastrarRepresentante');

    

});        

