<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'PessoaFisica', 'middleware' => 'pessoaFisica'], function(){
    // Authentication Routes...
    Route::get('login', 'PessoaFisicaAuth\LoginController@showLoginForm')->name('login.pf');
    Route::post('login', 'PessoaFisicaAuth\LoginController@login')->name('login.pessoaFisica');
    Route::post('logout', 'PessoaFisicaAuth\LoginController@logout');
    
    // Registration Routes...
    Route::get('register', 'PessoaFisicaAuth\RegisterController@showRegistrationForm');
    Route::post('register', 'PessoaFisicaAuth\RegisterController@register');
    
    // Password Reset Routes...
    Route::get('password/reset', 'PessoaFisicaAuth\ForgotPasswordController@showLinkRequestForm');
    Route::post('password/email', 'PessoaFisicaAuth\ForgotPasswordController@sendResetLinkEmail');
    Route::get('password/reset/{token}', 'PessoaFisicaAuth\ResetPasswordController@showResetForm');
    Route::post('password/reset', 'PessoaFisicaAuth\ResetPasswordController@reset');

    Route::get('/home', function () {
        return view('pessoaFisicaAuth.home');
    })->name('PessoaFisica.home');

    Route::get('/', function () {
        return view('pessoaFisicaAuth.dashboard');
    })->name('pessoaFisica.dashboard');
});

Route::group(['prefix' => 'pessoaJuridica'], function(){
    // Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login.pj');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout');
    
    // Registration Routes...
    Route::get('register', 'Auth\RegisterController@showRegistrationForm');
    Route::post('register', 'Auth\RegisterController@register');
    
    // Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
});
