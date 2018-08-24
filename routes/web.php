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


Route::get('/', 'MainController@index');
Route::get('/detail', function () {
    return view('detail');
});
Route::get('/register', 'AuthController@register');
Route::post('/register', 'AuthController@registerPost');

Route::get('/login', 'AuthController@login');
Route::post('/login', 'AuthController@loginPost');
Route::get('/logout', 'AuthController@logout');
Route::get('/dashboard', 'HomeController@index');
Route::post('/update-personal', 'HomeController@updatePersonal');
Route::post('/update-personal/{id}', 'HomeController@updateProfileById');
Route::get('/kode-diskon', 'MainController@kodeDiskon');

Route::get('verify/{token}','VerifyController@verify');
Route::post('/buy/','MainController@saveIdKategori');
Route::get('/profile/','MainController@profile');
Route::get('/personal/tambah', 'HomeController@tambahPersonal');
Route::post('/personal/tambah', 'HomeController@tambahPersonalPost');
Route::post('/personal/medical/{id}', 'HomeController@tambahPersonalMedical');

Route::get('/personal/{id}','HomeController@detail');
Route::post('/profile/','MainController@profileUpdate');
Route::get('/checkout/{id?}','MainController@checkout');
Route::get('/{id}', 'MainController@show');
Route::get('/checkout/total/{id}', 'MainController@total');
Route::post('/checkout/', 'MainController@checkoutPost');
Route::get('/trx/{id}', 'MainController@trx');
Route::get('/partisipan/tambah/{id}', 'MainController@tambahPartisipan');
Route::get('/invoice/{id}', 'MainController@invoice');
Route::get('/partisipan/{id}/hapus', 'HomeController@hapusPartisipan');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// });

// Route::get('/profile', function () {
//     return view('profile');
// });
