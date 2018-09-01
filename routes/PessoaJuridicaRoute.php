<?php

Route::group(['prefix' => 'PessoaJuridica', 'middleware' => 'pessoaJuridica'], function(){
    
    Route::get('/home', 'PessoaJuridicaController@index')->name('pessoaJuridica.home');
});        