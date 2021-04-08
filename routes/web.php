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
//role 1 = admin
//role 2 = member

Route::get('pengguna/login', 'UsersController@login');
Route::post('pengguna/registrasi', 'UsersController@registrasi');
Route::post('pengguna/validasi', 'UsersController@cekLogin');
Route::get('/', 'DashboardController@index');

Route::group(['middleware' => ['role:1']], function () {
Route::get('/buku/list', 'BukuController@index');
Route::get('/buku/add', 'BukuController@add');
Route::get('/buku/edit/{id?}', 'BukuController@edit');
Route::get('/buku/delete/{id?}', 'BukuController@delete');
Route::get('/rak/list', 'RakController@index');
Route::get('/rak/edit/{id?}', 'RakController@edit');
Route::post('/rak/add', 'RakController@create');
Route::get('/log/transaksi', 'UsersController@transaksi');

Route::get('/pengguna/list', 'UsersController@index');
Route::get('/pengguna/edit/{id?}', 'UsersController@edit');
Route::get('/pesanan/list', 'TransaksiController@pesanan');
Route::get('/penerimaan/list', 'TransaksiController@penerimaan');
Route::post('/order/proses/{id?}', 'TransaksiController@keluar');
Route::post('/penerimaan/proses/{id?}', 'TransaksiController@masuk');
Route::get('/penyesuaian', 'TransaksiController@adjustmentsaldo');
Route::post('/penyesuaian/baru', 'TransaksiController@adjustmentmasuk');
});

Route::group(['middleware' => ['role:2']], function () {
    Route::get('/produk/list', 'TransaksiController@index');
    Route::get('/pengguna/transaksi', 'UsersController@transaksi');
    Route::get('/produk/cek/{id?}', 'TransaksiController@cekstok');
    Route::get('/order/{id?}', 'TransaksiController@order');
});
