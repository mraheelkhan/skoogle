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
Route::get('/home', 'HomeController@index')->name('home');
//Dashboard
Route::get('/dashboard', 'HomeController@dashboard')->middleware('auth')->name('dashboard');
Route::get('/changepassword', ['as' => 'changepassword' , function () {
    return view('changepassword');
}])->middleware('auth');

Route::get('/profile', ['as' => 'profile' , function () {
    return view('profile');
}])->middleware('auth');

//Roles
Route::get('/roles/deactivate/{id}', 'RoleController@deactivate')->middleware('auth');
Route::get('/roles/active/{id}', 'RoleController@active')->middleware('auth');
Route::resource('roles', 'RoleController')->middleware('auth');

 //Staff/Admins
 Route::group(['prefix'=> 'admins'],function(){
    Route::get('create', 'UserController@create')->middleware('can:create-staff')->name('admins.create');
    Route::post('', 'UserController@store')->middleware('can:create-staff')->name('admins.store');   
    Route::get('', 'UserController@index')->middleware('can:admins-index')->name('admins.index');
    Route::get('fetch', 'UserController@fetch')->middleware('can:admins-index')->name('admins.fetch');
    Route::get('{id}', 'UserController@show')->middleware('can:show-staff')->name('admins.show');
    Route::delete('delete/{id}', 'UserController@destroy')->middleware('can:delete-staff')->name('admins.destroy');
    Route::get('{id}/edit', 'UserController@edit')->middleware('can:edit-staff')->name('admins.edit');
    Route::patch('{id}', 'UserController@update')->middleware('auth')->name('admins.update');
    //Staff Status
    Route::get('resetpassword/{id}', 'UserController@resetPassword')->middleware('can:staff-reset-password')->name('resetpassword');
    Route::get('deactivate/{id}', 'UserController@deactivate')->middleware('can:status-staff');
    Route::get('active/{id}', 'UserController@active')->middleware('can:status-staff');
    
 });


  //Settings 
  Route::group(['prefix'=> 'settings'],function(){
    //Settings-->Departments
    Route::get('departments', 'DepartmentController@index')->middleware('can:departments-index')->name('departments');
    Route::post('/departments/fetch', 'DepartmentController@fetch')->middleware('can:departments-index')->name('departments.fetch');
    Route::post('departments', 'DepartmentController@store')->middleware('can:create-department')->name('departments.store');  
    Route::post('/department/edit', 'DepartmentController@edit')->middleware('can:edit-department')->name('department.edit'); 
    Route::patch('/department/update', 'DepartmentController@update')->middleware('can:edit-department')->name('department.update');
    Route::post('/department/deactivate', 'DepartmentController@deactivate')->middleware('can:status-department')->name('department.deactivate');
    Route::post('/department/active', 'DepartmentController@active')->middleware('can:status-department')->name('department.active');
    Route::delete('/department/delete/{id}', 'DepartmentController@destroy')->middleware('can:delete-department')->name('department.destroy');

    //Settings-->Designations
    Route::get('designations', 'DesignationController@index')->middleware('can:designations-index')->name('designations');
    Route::post('/designations/fetch', 'DesignationController@fetch')->middleware('can:designations-index')->name('designations.fetch');
    Route::post('designations', 'DesignationController@store')->middleware('can:create-designation')->name('designation.store');  
    Route::post('/designation/edit', 'DesignationController@edit')->middleware('can:edit-designation')->name('designation.edit'); 
    Route::patch('/designation/update', 'DesignationController@update')->middleware('can:edit-designation')->name('designation.update');
    Route::post('/designation/deactivate', 'DesignationController@deactivate')->middleware('can:status-designation')->name('designation.deactivate');
    Route::post('/designation/active', 'DesignationController@active')->middleware('can:status-designation')->name('designation.active');
    Route::delete('/designation/delete/{id}', 'DesignationController@destroy')->middleware('can:delete-designation')->name('designation.destroy');

  });

   //Customers
 Route::group(['prefix'=> 'customers'],function(){
    Route::get('create', 'CustomerController@create')->middleware('can:create-customer')->name('customers.create');
    Route::post('', 'CustomerController@store')->middleware('can:create-customer')->name('customers.store');   
    Route::get('', 'CustomerController@index')->middleware('can:customers-index')->name('customers.index');
    Route::get('{id}', 'CustomerController@show')->middleware('can:show-customer')->name('customers.show');
    Route::delete('delete/{id}', 'CustomerController@destroy')->middleware('can:delete-customer')->name('customers.destroy');
    Route::get('{id}/edit', 'CustomerController@edit')->middleware('can:edit-customer')->name('customers.edit');
    Route::patch('{id}', 'CustomerController@update')->middleware('auth')->name('customers.update');

    //Staff Status
    Route::get('resetpassword/{id}', 'UserController@resetPassword')->middleware('can:reset-customer-password')->name('customer.resetpassword');
    Route::get('deactivate/{id}', 'UserController@deactivate')->middleware('can:status-customer');
    Route::get('active/{id}', 'UserController@active')->middleware('can:status-customer');
    
 });
  //Admin Menu
  Route::get('/menu/deactivate/{id}', 'AdminmenuController@deactivate')->middleware('can:menu-index');
  Route::get('/menu/active/{id}', 'AdminmenuController@active')->middleware('can:menu-index');
  Route::resource('menu', 'AdminmenuController')->middleware('can:menu-index');
 












