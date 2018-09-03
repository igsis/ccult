<?php

Route::group(['prefix' => 'PessoaFisica', 'middleware' => 'pessoaFisica'], function(){

    Route::get('/home', 'PessoaFisicaController@index')->name('pessoaFisica.home');

    Route::get('/cadastro' , 'PessoaFisicaController@show')->name('pessoaFisica.cadastro');

    // Route::post('/cadastro' , 'PessoaFisicaController@create')->name('pessoaFisica.create');

     Route::post('/atualizar' , 'PessoaFisicaController@update')->name('pessoaFisica.atualizar');

    Route::put('/{id}' , 'PessoaFisicaController@update');

    Route::delete('/{id}' , 'PessoaFisicaController@destroy');
});    