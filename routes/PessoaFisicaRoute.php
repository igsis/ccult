<?php

Route::group(['prefix' => 'PessoaFisica', 'middleware' => 'pessoaFisica'], function(){

    Route::get('/home', 'PessoaFisicaController@index')->name('pessoaFisica.home');

    Route::get('/cadastro' , 'PessoaFisicaController@show')->name('pessoaFisica.cadastro');

    Route::post('/atualizar' , 'PessoaFisicaController@update')->name('pessoaFisica.atualizar');

    Route::get('/endereco' , 'PessoaFisicaController@endereco')->name('pessoaFisica.formEndereco');

    Route::post('/cadastroEndereco' , 'PessoaFisicaController@cadastroEndereco')->name('pessoaFisica.cadastroEndereco');

    Route::post('/atualizarEndereco' , 'PessoaFisicaController@atualizarEndereco')->name('pessoaFisica.atualizarEndereco');

    Route::get('/telefones' , 'PessoaFisicaController@formTelefones')->name('pessoaFisica.formTelefones');

    Route::post('/cadastroTelefone' , 'PessoaFisicaController@cadastroTelefone')->name('pessoaFisica.cadastroTelefone');

    Route::post('/atualizaTelefone' , 'PessoaFisicaController@atualizaTelefone')->name('pessoaFisica.atualizaTelefone');

    Route::put('/{id}' , 'PessoaFisicaController@update');

    Route::delete('/{id}' , 'PessoaFisicaController@destroy');
});    