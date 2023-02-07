<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\Home;
use App\Http\Controllers\Login;
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

Route::post('/log', [Login::class, 'Login']);
Route::get('/login', [Login::class, 'LoginShow']);
Route::get('/signup', [Login::class, 'RegistrationShow']);
Route::post('/createuser', [Login::class, '']);
Route::get('/', [Home::class, 'HomeShow']);
Route::get('/d', [Home::class, 'HomeShow']);
