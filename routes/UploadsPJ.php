<?php

Route::group(['prefix' => 'PessoaJuridica', 'middleware' => 'pessoaJuridica'], function(){

    Route::get('/Documentos', 'UploadPjController@viewUploads')->name('pessoaJuridica.upload.listar');

    Route::post('/Documentos', 'UploadPjController@upload')->name('pessoaJuridica.upload');
    

});        

