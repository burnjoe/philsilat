<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;



Route::get('login', [LoginController::class, 'showLoginForm'])
    ->name('login');

Route::post('login', [LoginController::class, 'login']);

Route::post('logout', [LoginController::class, 'logout'])
    ->name('logout');

Route::get('signup', [RegisterController::class, 'showRegistrationForm'])
    ->name('signup');

Route::post('signup', [RegisterController::class, 'register']);

Route::get('forgot-password', 'Auth\ForgotPasswordController@showLinkRequestForm')
    ->name('password.request');

Route::post('forgot-password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')
    ->name('password.email');

Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')
    ->name('password.reset');

Route::post('password/reset', 'Auth\ResetPasswordController@reset');