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


 if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
// Ignores notices and reports all other kinds... and warnings
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
// error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}

Route::get('/', 'MainController@index');

// Route::get('/detail', function () {
//     return view('detail');
// });


Route::group(['prefix' => 'api/v1'], function() {
    //
	Route::get('cek-partisipan', 'ApiController@cekPartisipan');
	Route::get('/detail-transaksi', 'ApiController@detailTransaksi');
});
Route::get('/mutasi', 'TransactionController@test');

Route::get('/mutasi/email/{code}', 'TransactionController@mail');
Route::get('/mutasi/json', 'TransactionController@json');

Route::get('/email/invoice', 'MainController@mail');
Route::get('/register', 'AuthController@register');
Route::post('/register', 'AuthController@registerPost');
Route::get('/mutasi/kirim-email', 'TransactionController@mail');
Route::get('/delete-cart', 'HomeController@removePartisipanFromCart');
Route::get('/login', 'AuthController@login');
Route::post('/login', 'AuthController@loginPost');
Route::get('/logout', 'AuthController@logout');
Route::get('/dashboard', 'HomeController@index');
Route::post('/update-personal', 'HomeController@updatePersonal');
Route::post('/reverify', 'HomeController@reverify');
Route::post('/update-personal/{id}', 'HomeController@updateProfileById');
Route::get('/kode-diskon', 'MainController@kodeDiskon');
Route::get('partisipan-add', 'HomeController@addPartisipan');
Route::get('verify/{token}','VerifyController@verify');
Route::post('/buy/','MainController@saveIdKategori');
Route::get('/profile/','MainController@profile');
Route::get('/personal/tambah', 'HomeController@tambahPersonal');
Route::post('/personal/tambah', 'HomeController@tambahPersonalPost');
Route::post('/personal/medical/{id}', 'HomeController@tambahPersonalMedical');

Route::post('/update-emergency','HomeController@updateEmergency');
Route::get('/personal/{id}','HomeController@detail');
Route::post('/profile/','MainController@profileUpdate');
Route::get('/checkout/{id?}','MainController@checkout');
Route::get('/transaksi', 'MainController@daftarTransaksi');
Route::get('provinsi', 'MainController@provinsi');
Route::get('nik', 'MainController@nik');
Route::get('cari-kota', 'MainController@cariKota');
Route::get('/{id}', 'MainController@show');
Route::get('/checkout/total/{id}', 'MainController@total');
Route::post('/checkout/', 'MainController@checkoutPost');
Route::get('/trx/{id}', 'MainController@trx');
Route::get('/partisipan/tambah/{id}', 'MainController@tambahPartisipan');
Route::get('/invoice/{id}', 'MainController@invoice');
Route::post('/partisipan/{id}', 'HomeController@hapusPartisipan');
Route::group(['prefix' => 'admin'], function() {
    //
// 	Route::get('/admin/index', 'AdminController@index');
// Route::get('admin/index/data', 'AdminController@data');
Route::get('/event/data', 'EventController@data');
Route::resource('event', 'EventController');

Route::post('event/create','EventController@store');


Route::get('/member/data', 'MemberController@data');
Route::resource('member', 'MemberController');

Route::get('/invoice/data', 'InvoiceController@data');
Route::resource('invoice', 'InvoiceController');

});
// Route::get('/dashboard', function () {
//     return view('dashboard');
// });

// Route::get('/profile', function () {
//     return view('profile');
// });
