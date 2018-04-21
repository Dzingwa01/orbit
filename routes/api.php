<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login_user','ApiLoginController@login');
Route::get('/get_employees/{id}','EmployeesController@apiGetEmployees');
Route::get('/get_employees/{id}','EmployeesController@apiGetEmployees');
Route::get('/get_roles/{user}','EmployeeRolesController@apiGetRoles');
Route::get('/get_teams/{user}','TeamsController@apiGetTeams');
Route::get('/get_materials/{user}','TrainingMaterialsController@apiGetMaterials');
Route::get('/get_current_shift/{user}','ShiftsController@getCurrentShift');
Route::get('/get_current_shifts/{user}','ShiftsController@getCurrentShifts');
Route::get('/get_current_shifts_manager/{user}','ShiftsController@getCurrentShiftsManager');
Route::get('/get_current_shifts_manager_all/{user}','ShiftsController@getCurrentShiftsManagerAll');
Route::get('/get_current_tasks/{user}','TasksController@getCurrentTasks');
Route::get('/get_employee_teams/{user}','TeamsController@getEmployeeTeams');
Route::group(['prefix' => 'v1','middleware' => 'auth:api'], function () {
    //    Route::resource('task', 'TasksController');
    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_api_routes


});
