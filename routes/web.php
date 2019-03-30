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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['role:superadministrator', 'auth'])->group(function () {
    Route::get('/users_list', 'UserController@getUsers')->name('admin.user.list');
    Route::put('/user/{user}', 'UserController@changeRoles')->name('admin.user.change_roles');
    Route::post('/user/permissions/{user}', 'UserController@changePermissions')->name('admin.user.change_permissions');

    Route::get('roles', 'RoleController@index')->name('admin.role.list');
    Route::get('/role/create', 'RoleController@create')->name('admin.role.create');
    Route::post('/role/create', 'RoleController@create')->name('admin.role.store');
    Route::get('/role/edit/{role}', 'RoleController@edit')->name('admin.role.edit');
    Route::post('/role/edit/{role}', 'RoleController@edit')->name('admin.role.update');

    Route::get('/permissions', 'PermissionController@index')->name('admin.permission.list');
    Route::get('/permission/create', 'PermissionController@create')->name('admin.permission.create');
    Route::post('/permission/create', 'PermissionController@create')->name('admin.permission.store');
    Route::get('/permission/edit/{permission}', 'PermissionController@edit')->name('admin.permission.edit');
    Route::post('/permission/edit/{permission}', 'PermissionController@edit')->name('admin.permission.update');

    Route::get('/admin/advertisers', 'AdvertiserController@adminAdvertiserList')->name('admin.advertiser.list');
    Route::get('/admin/adverts', 'AdvertController@index')->name('admin.adverts.list');

    Route::get('/admin/accept_request/{withdrawRequest}', 'NonProfitOrganizationController@acceptTransaction')
        ->name('admin.non_profit_organization.accept_transaction');

    Route::post('/admin/accept_request/{withdrawRequest}', 'NonProfitOrganizationController@acceptTransaction')
        ->name('admin.non_profit_organization.submit_transaction');
});

Route::middleware(['auth'])->group(function () {
    Route::get('user/{user}', 'UserController@profile')->name('user.profile');
    Route::post('user/{user}', 'UserController@editProfile')->name('user.profile.edit');
    Route::patch('user/{user}', 'UserController@changePassword')->name('user.change_password');
});

Route::middleware(['role:user|advertiser', 'auth'])->group(function (){
    Route::get('/advertiser/create', 'AdvertiserController@create')->name('advertiser.create');
    Route::post('/advertiser/create', 'AdvertiserController@create')->name('advertiser.store');
    Route::get('/advertisers/{user}', 'AdvertiserController@getAdvertisers')->name('advertiser.list');
    Route::get('/edit_advert/{advert}', 'AdvertController@edit')->name('advertiser.advert.edit');
    Route::post('/edit_advert/{advert}', 'AdvertController@edit')->name('advertiser.advert.update');
});

Route::middleware(['role:advertiser|superadministrator', 'auth'])->prefix('advertiser')->group(function (){
    Route::get('{advertiser}', 'AdvertiserController@profile')->name('advertiser.profile');
    Route::get('{advertiser}/upload_advert', 'AdvertController@create')->name('advertiser.advert.create');
    Route::post('{advertiser}/upload_advert', 'AdvertController@create')->name('advertiser.advert.store');
    Route::get('{advert}/change_status', 'AdvertController@changeStatus')->name('advertiser.advert.change_status');
    Route::post('{advert}/change_status', 'AdvertController@changeStatus')->name('advertiser.advert.submit_change_status');
});


Route::middleware(['role:user|non_profit_organization', 'auth'])->group(function (){
    Route::get('/non_profit_organization/create', 'NonProfitOrganizationController@create')->name('non_profit_organization.create');
    Route::post('/non_profit_organization/create', 'NonProfitOrganizationController@create')->name('non_profit_organization.store');
    Route::get('/transactions/{withdrawRequest}', 'NonProfitOrganizationController@viewTransactions')->name('non_profit_organization.transactions');
});

Route::middleware(['role:superadministrator|non_profit_organization', 'auth'])->prefix('non_profit_organization')
    ->group(function (){
        Route::get('/{organization}', 'NonProfitOrganizationController@profile')->name('non_profit_organization.profile');
        Route::get('/{organization}/withdraw', 'NonProfitOrganizationController@withdrawMoney')->name('non_profit_organization.withdraw');
        Route::post('/{organization}/withdraw', 'NonProfitOrganizationController@withdrawMoney')->name('non_profit_organization.withdraw_submit');
    });