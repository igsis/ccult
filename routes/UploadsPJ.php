<?php

Route::group(['prefix' => 'PessoaJuridica', 'middleware' => 'pessoaJuridica'], function(){

    Route::get('/Documentos', 'UploadPjController@listar')->name('pessoaJuridica.upload.listar');
    

});        

