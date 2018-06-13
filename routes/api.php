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
Route::get('/get_employee_materials/{user}','TrainingMaterialsController@apiGetEmployeeMaterials');
Route::get('/get_current_shift/{user}','ShiftsController@getCurrentShift');
Route::get('/get_current_shifts/{user}','ShiftsController@getCurrentShifts');
Route::get('/get_current_shifts_manager/{user}','ShiftsController@getCurrentShiftsManager');
Route::get('/get_current_shifts_manager_all/{user}','ShiftsController@getCurrentShiftsManagerAll');
Route::get('/get_current_tasks/{user}','TasksController@getCurrentTasks');
Route::get('/get_current_tasks_manager/{user}','TasksController@getCurrentManagerTasks');
Route::get('/get_shift_employees/{shift}','TeamsController@getCurrentShiftEmployees');
Route::get('/get_leave_requests/{user}','ShiftsController@getLeaveRequests');

Route::get('/get_team_employees/{team}','TeamsController@getCurrentTeamEmployees');
Route::get('/get_employee_teams/{user}','TeamsController@getCurrentShiftTeams');
Route::get('/get_current_team_shifts/{user}/{shift_schedule}','ShiftsController@getCurrentTeamMemberShifts');
Route::get('/get_available_members/{user}/{shift_schedule}','ShiftsController@getCurrentAvailableTeamMembers');
Route::post('/store_shift_swap', 'ShiftsController@storeShiftSwapApi');
Route::post('/store_shift_offer', 'ShiftsController@storeShiftOfferApi');
Route::post('/store_off_request', 'ShiftsController@createLeaveRequest');

Route::get('/get_swap_requests/{user}','ShiftsController@getSwapRequests');
Route::get('/get_off_requests/{user}','ShiftsController@getOffRequests');

Route::get('/get_user_messages/{user}','MessagesController@getMessagesApi');
Route::post('/store_user_message','MessagesController@store');

Route::post('/accept_leave_request/{leave_request}/{manager}','ShiftsController@acceptLeaveRequest');
Route::post('/store_shift',"ShiftsController@storeShiftApi");
Route::post('/accept_shift_swap/{swap_shift}','ShiftsController@acceptShiftSwap');
Route::post('/accept_shift_offer/{shift_offer}','ShiftsController@acceptOffer');
Route::post('/update_user/{user}','UsersController@updateUserAPI');
Route::post('/store_chat_message','TeamsController@storeChatMessage');
Route::get('/get_chat_messages/{user}','TeamsController@getChatMessages');
Route::group(['prefix' => 'v1','middleware' => 'auth:api'], function () {
    //    Route::resource('task', 'TasksController');
    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_api_routes


});
