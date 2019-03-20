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
});

Route::middleware(['role:advertiser|superadministrator', 'auth'])->prefix('advertiser')->group(function (){
    Route::get('{advertiser}', 'AdvertiserController@profile')->name('advertiser.profile');
});
