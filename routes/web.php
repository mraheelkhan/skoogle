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
    // return redirect(route('ForumAll'));
    return view('index');
});

Route::get('/logout', function(){
  Auth::logout();
  return redirect(route('ForumAll'));
})->name('LogOutSystem');
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
 

// Categories
Route::get('/category', 'CategoryController@index')->middleware('can:category-index')->name('category.index');
Route::get('/category/fetch', 'CategoryController@fetch')->middleware('can:category-fetch')->name('category.fetch');
Route::post('/category/store', 'CategoryController@store')->middleware('can:category-store')->name('category.store');
Route::post('/category/edit', 'CategoryController@edit')->middleware('can:category-edit')->name('category.edit');
Route::post('category/active', 'CategoryController@categoryActive')->middleware('can:category-active')->name('category.active');
Route::post('category/disable', 'CategoryController@categoryDisable')->middleware('can:category-disable')->name('category.disable');
Route::post('categoryGetByCountry', 'CategoryController@categoryGetByCountry')->middleware('auth')->name('categoryGetByCountry');


Route::group(['prefix'=> 'settings'],function(){
    // Forum Monitoring 
    Route::get('/forum', 'ForumQuestionController@admin_all')->middleware('can:forum-adminindex')->name('forum.adminindex');
    Route::get('/forum/fetch', 'ForumQuestionController@adminfetch')->middleware('can:forum-adminfetch')->name('forum.adminfetch');
    Route::post('/forum/store', 'ForumQuestionController@adminupdate')->middleware('can:forum-adminstore')->name('forum.adminstore');
    Route::get('/forum/show/{id}', 'ForumQuestionController@adminshow')->middleware('can:forum-adminshow')->name('forum.adminshow');
    Route::post('/forum/edit', 'ForumQuestionController@adminedit')->middleware('can:forum-adminedit')->name('forum.adminedit');
    Route::post('forum/active', 'ForumQuestionController@adminforumActive')->middleware('can:forum-adminactive')->name('forum.adminactive');
    Route::post('forum/disable', 'ForumQuestionController@adminforumDisable')->middleware('can:forum-admindisable')->name('forum.admindisable');
    Route::post('forum/delete', 'ForumQuestionController@admindeleteanswer')->middleware('can:forum-adminedit')->name('forum.admindelete');
    
    // Job Monitoring
    Route::get('/job', 'JobController@admin_all')->middleware('can:job-adminindex')->name('job.adminindex');
    Route::get('/job/fetch', 'JobController@adminfetch')->middleware('can:job-adminfetch')->name('job.adminfetch');
    Route::post('/job/store', 'JobController@adminupdate')->middleware('can:job-adminstore')->name('job.adminstore');
    Route::get('/job/show/{id}', 'JobController@adminshow')->middleware('can:job-adminshow')->name('job.adminshow');
    Route::post('/job/edit', 'JobController@adminedit')->middleware('can:job-adminedit')->name('job.adminedit');
    Route::post('job/active', 'JobController@adminActive')->middleware('can:job-adminactive')->name('job.adminactive');
    Route::post('job/disable', 'JobController@adminDisable')->middleware('can:job-admindisable')->name('job.admindisable');
    Route::post('job/delete', 'JobController@adminDelete')->middleware('can:job-adminedit')->name('job.admindelete');
    
});



//=================================
//========= FRONT ROUTES ==========
//=================================

// Job routes for users only
Route::get('/forum', 'ForumQuestionController@index')->name('forum.index');
Route::get('/forum', 'ForumQuestionController@index')->name('ForumAll');
Route::get('/forum/ask', 'ForumQuestionController@create')->middleware('auth')->name('ForumCreate');
Route::post('/forum/store', 'ForumQuestionController@store')->middleware('auth')->name('ForumStore');
Route::get('/forum/question/{id}', 'ForumQuestionController@show')->name('ForumShow');
Route::post('/forum/answer/store', 'ForumAnswerController@store')->middleware('auth')->name('QuestionAnswerStore');
Route::post('/forum/answer/solution', 'ForumAnswerController@markAsSolution')->middleware('auth')->name('AnswerMarkAsSolution');


// job posting and applying routes for user, admin and employer
Route::get('/jobs', 'JobController@index')->name('JobAll');
Route::get('/jobs/myjobs', 'JobController@myPostedJobs')->name('MyPostedJobs');
Route::get('/job/post', 'JobController@create')->middleware('auth')->name('JobCreate');
Route::post('/job/store', 'JobController@store')->middleware('auth')->name('JobStore');
Route::get('/job/edit/{id}', 'JobController@edit')->middleware('auth')->name('JobEdit');
Route::get('/job/{id}', 'JobController@show')->name('JobShow');
Route::post('/job/apply/store', 'JobController@apply')->middleware('auth')->name('JobApply');
Route::post('/job/close/', 'JobController@markAsClosed')->middleware('auth')->name('JobMarkAsClosed');
