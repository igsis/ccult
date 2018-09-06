<?php

Route::group(['prefix' => 'PessoaFisica', 'middleware' => 'pessoaFisica'], function(){

    Route::get('/home', 'PessoaFisicaController@index')->name('pessoaFisica.home');

    // Rotas de Pessoa Física Cadastro

    Route::get('/cadastro' , 'PessoaFisicaController@show')->name('pessoaFisica.cadastro');

    Route::post('/atualizar' , 'PessoaFisicaController@update')->name('pessoaFisica.atualizar'); 

    // Rota de Pendências

    Route::get('Pendecias', 'PessoaFisicaController@pendencias')->name('pessoaFisica.pendecias')->middleware('PendenciasPF');

    // Rotas de Endereço

    Route::get('/endereco' , 'PessoaFisicaController@endereco')->name('pessoaFisica.formEndereco');

    Route::post('/cadastroEndereco' , 'PessoaFisicaController@cadastroEndereco')->name('pessoaFisica.cadastroEndereco');

    Route::post('/atualizarEndereco' , 'PessoaFisicaController@atualizarEndereco')->name('pessoaFisica.atualizarEndereco');

    // Rotas de telefones

    Route::get('/telefones' , 'PessoaFisicaController@formTelefones')->name('pessoaFisica.formTelefones');

    Route::post('/cadastroTelefone' , 'PessoaFisicaController@cadastroTelefone')->name('pessoaFisica.cadastroTelefone');

    Route::post('/atualizaTelefone' , 'PessoaFisicaController@atualizaTelefone')->name('pessoaFisica.atualizaTelefone');

});    