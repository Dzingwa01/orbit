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

Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
    Route::resource('user','UsersController');
    Route::get('get_users','UsersController@getUsers')->name('users.get_users');
    Route::post('/update/user/{id}','UsersController@update');
    Route::get('delete_user/{id}','UsersController@destroy');

    Route::resource('package','PackagesController');
    Route::get('get_packages','PackagesController@getPackages')->name('packages.get_packages');
    Route::post('save_package/{package}','PackagesController@update');

    Route::resource('team','TeamsController');
    Route::get('get_teams','TeamsController@getTeams')->name('teams.get_teams');

    Route::get('/get_roles', 'RolesController@getRoles')->name('roles.get_roles');
    Route::get('create_role','RolesController@createRole');
    Route::post('/save_role','RolesController@saveRole');
    Route::get('view_role/{role}','RolesController@viewRole');
    Route::get('edit_role/{role}','RolesController@editRole');
    Route::get('delete_role/{role}','RolesController@deleteRole');
    Route::get('roles','RolesController@index');
    Route::post('/update_role/{role}','RolesController@updateRole');

    Route::get('/get_permissions', 'PermissionsController@getPermissions')->name('permissions.get_permissions');
    Route::get('create_permission','PermissionsController@createPermission');
    Route::post('/save_permission','PermissionsController@savePermission');
    Route::get('view_permission/{permission}','PermissionsController@viewPermission');
    Route::get('edit_permission/{permission}','PermissionsController@editPermission');
    Route::get('delete_permission/{permission}','PermissionsController@deletePermission');
    Route::get('permissions','PermissionsController@index');
    Route::post('update_permission/{permission}','PermissionsController@updatePermission');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
