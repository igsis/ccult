<?php

Route::group(['prefix' => 'PessoaFisica', 'middleware' => 'pessoaFisica'], function(){
    
    Route::get('/home', 'PessoaFisicaController@index')->name('pessoaFisica.home');
});    