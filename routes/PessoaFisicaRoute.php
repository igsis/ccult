<?php

Route::group(['prefix' => 'PessoaFisica', 'middleware' => 'pessoaFisica'], function(){

    Route::get('/home', 'PessoaFisicaController@index')->name('pessoaFisica.home');

    Route::get('/cadastro' , 'PessoaFisicaController@formRegister')->name('pessoaFisica.formRegister');

    Route::post('/cadastro' , 'PessoaFisicaController@create')->name('pessoaFisica.create');

     Route::get('/atualizar' , 'PessoaFisicaController@update');

    Route::put('/{id}' , 'PessoaFisicaController@update');

    Route::delete('/{id}' , 'PessoaFisicaController@destroy');
});    