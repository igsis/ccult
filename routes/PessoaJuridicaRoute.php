<?php

Route::group(['prefix' => 'PessoaJuridica', 'middleware' => 'pessoaJuridica'], function(){
    
    Route::get('/home', 'PessoaJuridicaController@index')->name('pessoaJuridica.home');

    Route::get('/cadastro' , 'PessoaJuridicaController@show')->name('pessoaJuridica.cadastro');

    Route::post('/atualizar' , 'PessoaJuridicaController@update')->name('pessoaJuridica.atualizar');

    Route::get('/endereco' , 'PessoaJuridicaController@endereco')->name('pessoaJuridica.formEndereco');

    Route::post('/cadastroEndereco' , 'PessoaJuridicaController@cadastroEndereco')->name('pessoaJuridica.cadastroEndereco');

    Route::post('/atualizarEndereco' , 'PessoaJuridicaController@atualizarEndereco')->name('pessoaJuridica.atualizarEndereco');

    Route::get('/telefones' , 'PessoaJuridicaController@formTelefones')->name('pessoaJuridica.formTelefones');

    Route::post('/cadastroTelefone' , 'PessoaJuridicaController@cadastroTelefone')->name('pessoaJuridica.cadastroTelefone');

    Route::post('/atualizaTelefone' , 'PessoaJuridicaController@atualizaTelefone')->name('pessoaJuridica.atualizaTelefone');
});        