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
    Route::get('item/getDetailsByItemId/{id?}', 'Admin\ItemController@getDetailsByItemId')->name('getDetailsByItemId');

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

    Route::get('step', 'Admin\StepController@index')->name('step');
    Route::get('step/create', 'Admin\StepController@create')->name('stepCreate');
    Route::post('step/stepSave', 'Admin\StepController@stepSave')->name('stepSave');
    Route::get('step/edit/{id}', 'Admin\StepController@edit')->name('stepEdit');
    Route::post('step/stepUpdate', 'Admin\StepController@stepUpdate')->name('stepUpdate');
    Route::get('step/stepDelete/{id}', 'Admin\StepController@stepDelete')->name('stepDelete');

    Route::get('cost', 'Admin\CostController@index')->name('cost');
    Route::get('cost/create', 'Admin\CostController@create')->name('costCreate');
    Route::post('cost/addDetailsToTable', 'Admin\CostController@addDetailsToTable')->name('addDetailsToTable');
    Route::get('cost/removeDetailsFromTable/{id}', 'Admin\CostController@removeDetailsFromTable')->name('removeDetailsFromTable');
    Route::get('cost/clearDetailsFromTable', 'Admin\CostController@clearDetailsFromTable')->name('clearDetailsFromTable');
    Route::post('cost/costSave', 'Admin\CostController@costSave')->name('costSave');
    Route::get('cost/edit/{id}', 'Admin\CostController@edit')->name('costEdit');
    Route::post('cost/costUpdate', 'Admin\CostController@costUpdate')->name('costUpdate');
    Route::get('cost/costDelete/{id}', 'Admin\CostController@costDelete')->name('costDelete');
    Route::get('cost/stepWiseCostDetails', 'Admin\CostController@stepWiseCostDetails')->name('stepWiseCostDetails');

    Route::get('letter', 'Admin\LetterController@index')->name('letter');
    Route::get('letter/create', 'Admin\LetterController@create')->name('letterCreate');
    Route::post('letter/letterSave', 'Admin\LetterController@letterSave')->name('letterSave');
    Route::get('letter/edit/{id}', 'Admin\LetterController@edit')->name('letterEdit');
    Route::post('letter/letterUpdate', 'Admin\LetterController@letterUpdate')->name('letterUpdate');
    Route::get('letter/letterDelete/{id}', 'Admin\LetterController@letterDelete')->name('letterDelete');
    Route::get('letter/letterPrintToPdf/{id}', 'Admin\LetterController@letterPrintToPdf')->name('letterPrintToPdf');
    //Route::get('letter/letterDetailsPrint/{id}', 'Admin\LetterController@letterDetailsPrint')->name('letterDetailsPrint');
    Route::get('letter/letterDetailsPrint', 'Admin\LetterController@letterDetailsPrint')->name('letterDetailsPrint');

    Route::get('reports/supplierwiseReport', 'Admin\ReportsController@supplierwiseReport')->name('supplierwiseReport');
    Route::post('reports/supplierwiseReportView', 'Admin\ReportsController@supplierwiseReportView')->name('supplierwiseReportView');

});


