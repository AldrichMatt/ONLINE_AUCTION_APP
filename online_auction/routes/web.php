<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\Home;
use App\Http\Controllers\Login;
use App\Http\Controllers\Offer;
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

Route::get('/admin', [Admin::class, 'LoginShow']);

Route::post('/log', [Login::class, 'Login']);
Route::get('/login', [Login::class, 'LoginShow']);
Route::get('/logout', [Login::class, 'Logout']);

Route::get('/signup', [Login::class, 'RegistrationShow']);
Route::post('/register', [Login::class, 'Register']);

Route::get('/d', [Home::class, 'HomeShow']);
Route::get('/', [Home::class, 'HomeShow']);

Route::get('/offers', [Offer::class, 'OfferShow']);
Route::post('/offer/bid/{auction_id}/{user_id}', [Offer::class, 'Bid']);
// Route::get('/offer/bid/{auction_id}/{user_id}', [Offer::class, 'Bid']);

Route::get('/item/{item_id}', [Offer::class, 'SingleItemShow']);
