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

Route::get('send_test_email', function(){
    Mail::raw('Hi, Yonela, this is a test message from Orbit.!', function($message)
    {
        $message->subject('Test message from Orbit!');
        $message->from('admin@orbit.co.za', 'Orbit');
        $message->to('yonela@ntshangacapital.co.za');
        $message->to('tongaichiridza@gmail.com');
        $message->to('tongai@avochoc.com');
    });
});

Route::get('/', function () {
//    dd(phpinfo());
    $packages = App\Package::where('package_name','!=','Individual Account')->orderBy('number_of_members','ASC')->get();
    $individual_package = App\Package::where('number_of_members',1)->first();
    return view('welcome',compact('packages','individual_package'));
});
Route::get('contact_us',function(){
   return view('contact_us');
});
Route::get('service_policy',function(){
   return view('privacy_policy');
});
Route::get('/phpinfo', function() {
    return phpinfo();
});
Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
    Route::get('get_employee_name/{user}','UsersController@getName');
    Route::get('team_employee_shifts/{team}','SchedulerController@getTeamEmployeeShifts');
    Route::resource('user','UsersController');
    Route::get('get_users','UsersController@getUsers')->name('users.get_users');
    Route::post('/update/user/{id}','UsersController@update');
    Route::get('delete_user/{id}','UsersController@destroy');

    Route::resource('employees','EmployeesController');
    Route::get('get_employees','EmployeesController@getUsers')->name('employees.get_employees');
    Route::post('/update/employee/{user}','EmployeesController@update');
    Route::get('delete_employee/{user}','EmployeesController@destroy');

    Route::resource('package','PackagesController');
    Route::get('get_packages','PackagesController@getPackages')->name('packages.get_packages');
    Route::post('save_package/{package}','PackagesController@update');
    Route::get('delete_package/{package}','PackagesController@destroy');

    Route::resource('city','CitiesController');
    Route::get('get_cities','CitiesController@getCities')->name('cities.get_cities');
    Route::post('save_city/{city}','CitiesController@update');
    Route::get('delete_city/{city}','CitiesController@destroy');

    Route::resource('team','TeamsController');
    Route::get('get_teams','TeamsController@getTeams')->name('teams.get_teams');
    Route::post('save_team/{team}','TeamsController@update');
    Route::get('delete_team/{team}','TeamsController@destroy');
    Route::post('/add_team_members/','TeamsController@managersTeamMembers');

//    Route::resource('employee_roles','EmployeeRolesController');
    Route::get('/get_employee_roles', 'EmployeeRolesController@getRoles')->name('employee_roles.get_roles');
    Route::get('employee_create_role','EmployeeRolesController@createRole');
    Route::post('/employee_save_role','EmployeeRolesController@saveRole');
    Route::get('employee_view_role/{role}','EmployeeRolesController@viewRole');
    Route::get('employee_edit_role/{role}','EmployeeRolesController@editRole');
    Route::get('employee_delete_role/{role}','EmployeeRolesController@deleteRole');
    Route::get('employee_roles','EmployeeRolesController@index');
    Route::post('/employee_update_role/{role}','EmployeeRolesController@updateRole');

    Route::resource('shifts','ShiftsController');
    Route::get('get_shifts','ShiftsController@getShifts')->name('shifts.get_shifts');
    Route::post('update_shift/{shift}','ShiftsController@update');
    Route::get('delete_shift/{shift}','ShiftsController@destroy');

    Route::resource('schedules','SchedulerController');

    Route::resource('training_materials','TrainingMaterialsController');
    Route::get('delete_material/{material}','TrainingMaterialsController@destroy');
    Route::get('get_training_materials','TrainingMaterialsController@getTrainingMaterials')->name('training_materials.get_materials');
    Route::post('update_training_materials/{id}','TrainingMaterialsController@update');

    Route::resource('onboarding_materials','OnBoardingMaterialsController');
    Route::get('get_onboarding_materials','OnBoardingMaterialsController@getTrainingMaterials')->name('onboarding_materials.get_materials');
    Route::post('update_onboarding_materials/{id}','OnBoardingMaterialsController@update');

    Route::resource('tasks', 'TasksController');
    Route::post('shift_tasks','TasksController@shiftTasks');
    Route::post('another_shift_tasks','TasksController@shiftTasksExisting');
    Route::get('get_tasks','TasksController@getTasks')->name('tasks.get_tasks');
    Route::get('delete_tasks/{task}','TasksController@destroy');
    Route::post('update_task/{task}','TasksController@update');

    Route::resource('manager_teams', 'ManagerTeamsController');
    Route::get('manager_teams_list','ManagerTeamsController@getTeams')->name('manager_teams.get_teams');
    Route::post('manager_save_team/{team}','ManagerTeamsController@update');
    Route::get('manager_delete_team/{team}','ManagerTeamsController@destroy');
    Route::post('manager_update_team_members','ManagerTeamsController@updateTeamMembers');

    Route::get('/get_roles', 'RolesController@getRoles')->name('roles.get_roles');
    Route::get('create_role','RolesController@createRole');
    Route::post('/save_role','RolesController@saveRole');
    Route::get('view_role/{role}','RolesController@viewRole');
    Route::get('edit_role/{role}','RolesController@editRole');
    Route::get('delete_role/{role}','RolesController@deleteRole');
    Route::get('roles','RolesController@index');
    Route::post('/update_role/{role}','RolesController@updateRole');

    Route::post('/store_leave_request','ShiftsController@createLeaveRequest');

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
Route::get('/account_creation_success','Auth\RegisterController@accountSuccess');
Route::get('/account_not_verified','Auth\RegisterController@accountNotRegistered');
Route::get('/verify_email/{token}', 'Auth\RegisterController@verify');

Route::get('/invite_team_member/{email_token}','TeamsController@acceptTeamMember');
//Route::get('/manager', 'HomeController@index')->name('home');
