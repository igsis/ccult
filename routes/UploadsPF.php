<?php

Route::group(['prefix' => 'PessoaFisica', 'middleware' => 'pessoaFisica'], function(){

    Route::get('/ListaDocumentos', 'UploadPfController@listar')->name('pessoaFisica.upload');

});    