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

//Route::get('/', function () {
//    return view('welcome');
//});
//Route::get('/', 'HomeController@index')->name('home');
Route::get('/', 'Admin\SigninController@index')->name('admin');

//Auth::routes();

// Matches The "/admin/users" URL
Route::prefix('admin')->group(function () {
    Route::get('', 'Admin\SigninController@index')->name('admin');
    Route::get('/signin', 'Admin\SigninController@index')->name('adminSignin');
    Route::post('/login', 'Admin\SigninController@signinAction')->name('adminLogin');
    Route::get('/logout', 'Admin\SigninController@logout')->name('adminLogout');
    Route::get('/dashboard', 'Admin\DashboardController@index')->name('dashboard');

    Route::get('adminUser', 'Admin\AdminUserController@index')->name('adminUser');
    Route::get('adminUser/create', 'Admin\AdminUserController@create')->name('adminUserCreate');
    Route::post('adminUser/adminUserSave', 'Admin\AdminUserController@adminUserSave')->name('adminUserSave');
    Route::get('adminUser/edit/{id}', 'Admin\AdminUserController@edit')->name('adminUserEdit');
    Route::post('adminUser/adminUserUpdate', 'Admin\AdminUserController@adminUserUpdate')->name('adminUserUpdate');
    Route::get('adminUser/userProfile', 'Admin\AdminUserController@userProfile')->name('adminUserProfile');
    Route::post('adminUser/userProfileUpdateAction', 'Admin\AdminUserController@userProfileUpdateAction')->name('adminUserProfileUpdateAction');



    Route::get('item', 'Admin\ItemController@index')->name('item');
    Route::get('item/create', 'Admin\ItemController@create')->name('itemCreate');
    Route::post('item/itemSave', 'Admin\ItemController@itemSave')->name('itemSave');
    Route::get('item/edit/{id}', 'Admin\ItemController@edit')->name('itemEdit');
    Route::post('item/itemUpdate', 'Admin\ItemController@itemUpdate')->name('itemUpdate');
    Route::get('item/itemDelete/{id}', 'Admin\ItemController@itemDelete')->name('itemDelete');

    Route::get('supplier', 'Admin\SupplierController@index')->name('supplier');
    Route::get('supplier/create', 'Admin\SupplierController@create')->name('supplierCreate');
    Route::post('supplier/supplierSave', 'Admin\SupplierController@supplierSave')->name('supplierSave');
    Route::get('supplier/edit/{id}', 'Admin\SupplierController@edit')->name('supplierEdit');
    Route::post('supplier/supplierUpdate', 'Admin\SupplierController@supplierUpdate')->name('supplierUpdate');
    Route::get('supplier/supplierDelete/{id}', 'Admin\SupplierController@supplierDelete')->name('supplierDelete');

    Route::get('miscellaneous', 'Admin\MiscellaneousController@index')->name('miscellaneous');
    Route::get('miscellaneous/create', 'Admin\MiscellaneousController@create')->name('miscellaneousCreate');
    Route::post('miscellaneous/miscellaneousSave', 'Admin\MiscellaneousController@miscellaneousSave')->name('miscellaneousSave');
    Route::get('miscellaneous/edit/{id}', 'Admin\MiscellaneousController@edit')->name('miscellaneousEdit');
    Route::post('miscellaneous/miscellaneousUpdate', 'Admin\MiscellaneousController@miscellaneousUpdate')->name('miscellaneousUpdate');
    Route::get('miscellaneous/miscellaneousDelete/{id}', 'Admin\MiscellaneousController@miscellaneousDelete')->name('miscellaneousDelete');

});

