<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\Home;
use App\Http\Controllers\Admin;
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

Route::post('/admin/log', [Admin::class, 'Login']);
Route::get('/admin/login', [Admin::class, 'LoginShow']);
Route::get('/admin/logout', [Admin::class, 'Logout']);

Route::get('/admin/d', [Admin::class, 'DashboardShow']);
Route::get('/admin/auction', [Admin::class, 'AuctionShow']);

Route::get('/admin/item', [Admin::class, 'ItemShow']);
Route::get('/admin/item/{item_id}', [Admin::class, 'SingleItemShow']);

Route::get('/admin/user', [Admin::class, 'UserShow']);

Route::get('/admin/employee', [Admin::class, 'EmployeeShow']);

Route::get('/admin/report', [Admin::class, 'GenerateReport']);

Route::post('/admin/add/{subject_name}', [Admin::class, 'SubjectAdd']);
Route::get('/admin/delete/{subject_name}/{subject_id}', [Admin::class, 'DeleteSubject']);
Route::get('/admin/edit/{subject_name}/{subject_id}', [Admin::class, 'EditShow']);
Route::get('/admin/update/{subject_name}/{subject_id}', [Admin::class, 'UpdateSubject']);

Route::get('/admin/signup', [Admin::class, 'RegistrationShow']);
Route::post('/admin_register', [Admin::class, 'Register']);

Route::post('/log', [Login::class, 'Login']);
Route::get('/login', [Login::class, 'LoginShow']);
Route::get('/logout', [Login::class, 'Logout']);

Route::get('/signup', [Login::class, 'RegistrationShow']);
Route::post('/register', [Login::class, 'Register']);

Route::get('/d', [Home::class, 'HomeShow']);
Route::get('/', [Home::class, 'HomeShow']);

Route::get('/offers', [Offer::class, 'OfferShow']);
Route::post('/offer/bid/{auction_id}/{user_id}', [Offer::class, 'Bid']);

Route::get('/item/{item_id}', [Offer::class, 'SingleItemShow']);
