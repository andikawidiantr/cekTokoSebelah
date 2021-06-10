<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' =>true]);

Route::get('/home', function () {
    return view('home');
});
Route::get('/shop', 'HomeController@index')->middleware('auth');
Route::get('/shop/kategori/{id}','HomeController@kategorifilter');
Route::get('/shop/detail/{id}', 'HomeController@detailproduct')->middleware('auth');

// Route::get('/produk/buynow','BuyNowController@buynow');
Route::get('/shop/buynow', 'BuyNowController@buynow')->middleware('auth');
Route::post('/shop/store/buynow','BuyNowController@storebuynow')->middleware('auth');

Route::get('/shop/read-notif/{id}','HomeController@readNotifUser');

Route::get('/shop/cart','CartController@cartproduk');
Route::get('/shop/cart/{id}/deletecart','CartController@hapuscart');
Route::post('/shop/cart/store/','CartController@store');
Route::post('/shop/cart/update','CartController@updateCart');

Route::get('/transaksi', 'CheckoutController@tampiltransaksi');
Route::get('/shop/checkout','CheckoutController@checkoutproduk');
Route::post('/shop/cekongkir','CheckoutController@cekongkir');
Route::post('/shop/checkout-produk','CheckoutController@store');
Route::get('/shop/uploadbukti/{id}','CheckoutController@konfirmasiproduk');
Route::get('/shop/addreview/{id}','CheckoutController@addreview');
Route::post('/shop/cancel/{id}','CheckoutController@cancelproduk');
Route::post('/shop/uploadpembayaran/{id}','CheckoutController@uploadpembayaran');
Route::get('/shop/sukses-bayar/{id}','CheckoutController@suksesbayar');

Route::post('/produk/review','HomeController@tambahreview');
Route::get('/notifikasi','HomeController@tampilnotifikasi');

Route::prefix('admin')->group(function(){
    Route::get('/', 'AdminDashboardController@getDataPenjualan')->name('admin.dashboard');
    Route::get('/login', 'Auth\AdminLoginController@showLoginform')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    // Route::get('/', 'AdminController@index')->name('admin.dashboard')->middleware('auth:admin');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('/register', 'Auth\AdminRegisterController@showRegistrationForm')->name('admin.register');
    Route::post('/register','Auth\AdminRegisterController@register')->name('admin.register.submit');

    Route::get('/password/reset','Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/email','Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset{token}','Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('/password/reset','Auth\AdminResetPasswordController@reset')->name('admin.password.update');

    Route::get('/admin/read-notif/{id}','AdminDashboardController@readNotif');
    Route::get('/response/{id}','AdminDashboardController@admin_response');
    Route::post('/product/upload/response/{id}','AdminDashboardController@upload_response');

    Route::get('/transaksi','AdminDashboardController@index');
    Route::get('/detail-transaksi/{id}','AdminDashboardController@viewdetail');
    Route::post('/transaksi/{id}/status','AdminDashboardController@updatestatus');
    Route::post('/transaksi/{id}/verifikasi','AdminDashboardController@verifikasipembayaran');
    Route::get('/read-notif/{id}','AdminDashboardController@readNotif');
    Route::get('/notifikasi','AdminDashboardController@view_allnotif');

    //Courier
    // Route::resource('/courier','CourierController')->middleware('auth:admin');
    Route::get('/courier/trash','CourierController@trash')->name('courier.trash')->middleware('auth:admin');
    Route::resource('/courier','CourierController')->middleware('auth:admin');
    Route::get('/courier/delete/{id}','CourierController@hapus')->name('courier.hapus')->middleware('auth:admin');

    //Product
    Route::get('/product/trash','ProductController@trash')->name('product.trash')->middleware('auth:admin');
    Route::resource('/product','ProductController')->middleware('auth:admin');
    Route::get('/product/delete/{id}','ProductController@hapus')->name('product.hapus')->middleware('auth:admin');
    Route::delete('/product/deletefoto/{productimage:id}','ProductController@destroyfoto')->name('product.hapusfoto')->middleware('auth:admin');


    //Categories
    Route::get('/category/trash','CategoryController@trash')->name('category.trash')->middleware('auth:admin');
    Route::resource('/category','CategoryController')->middleware('auth:admin');
    Route::get('/category/delete/{id}','CategoryController@hapus')->name('category.hapus')->middleware('auth:admin');

    //Diskon
    Route::get('/discount/trash','DiscountController@trash')->name('discount.trash')->middleware('auth:admin');
    Route::resource('/discount','DiscountController')->middleware('auth:admin');
    Route::get('/discount/delete/{id}','DiscountController@hapus')->name('discount.hapus')->middleware('auth:admin');
    
});

