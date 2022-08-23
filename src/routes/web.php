<?php

namespace Jdanielduarte\Passwordgenerator\Routes;

use Jdanielduarte\Passwordgenerator\Controllers\PasswordsRegistadasController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('/passwordgenerator')->group(function () {
    Route::get('/', fn()=>view('passwordgenerator::index'));
    Route::get('/generate',[PasswordsRegistadasController::class,'generate'])->name('password.generate');
});