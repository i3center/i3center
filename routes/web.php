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

// Client

Route::get('/', 'ClientController@Index');

Route::post('/search', 'ClientController@Search');
Route::get('/calender', 'ClientController@Calender');
Route::get('/off', 'OffController@AllGetForClient');
Route::get('/about', 'ClientController@About');
Route::get('/icdl', 'ClientController@ICDL');
Route::get('/international-test-tour', 'ClientController@InternationalTestTour');
Route::get('/regulation', 'RegulationController@AllGetForClient');

// Contact
Route::group(['prefix' => '/contact',], function ()
{
    Route::get('/', 'MessageController@Index');
    Route::post('/add', 'MessageController@AddPost');
});

// Blog
Route::group(['prefix' => '/blog',], function ()
{
    Route::get('/', 'TopicController@AllGetForClient');
    Route::get('/{category}', 'TopicController@ByCategoryGet');
    Route::get('/{category}/{id}', 'TopicController@SingleGet');
});

// Course
Route::group(['prefix' => '/course',], function ()
{
    Route::get('/', 'CourseController@AllGetForClient');
    Route::get('/{id}', 'CourseController@SingleGet');
});

// I3class
Route::group(['prefix' => '/i3class',], function ()
{
    Route::get('/', 'I3classController@AllGetForClient');
    Route::get('/{id}', 'I3classController@SingleGet');
});

// Teacher
Route::group(['prefix' => '/teacher',], function ()
{
    Route::get('/', 'TeacherController@AllGetForClient');
    Route::get('/{id}', 'TeacherController@SingleGet');
});

// Employee
Route::group(['prefix' => '/employee',], function ()
{
    Route::get('/', 'EmployeeController@AllGetForClient');
    Route::get('/{id}', 'EmployeeController@SingleGet');
});

// Admin

Route::get('/admin/login', 'AdminController@LoginGet');
Route::post('/admin/login', 'AdminController@LoginPost');

Route::group(['prefix' => '/admin', 'middleware' => 'auth',], function ()
{
    Route::post('/upload-image', 'AdminController@uploadImage');

	Route::get('/', 'AdminController@Index');

	Route::get('/logout', 'AdminController@LogoutGet');

	// Category
	Route::group(['prefix' => '/blog/category',], function ()
	{
		Route::get('/', 'CategoryController@AllGet');
		Route::post('/add', 'CategoryController@AddPost');
		Route::post('/edit', 'CategoryController@EditPost');
		Route::get('/delete/{id}', 'CategoryController@DeleteGet');
	});

	// Topic
	Route::group(['prefix' => '/blog/topic',], function ()
	{
		Route::get('/add/', 'TopicController@AddGet');
		Route::post('/add/', 'TopicController@AddPost');
		Route::get('/edit/{id}', 'TopicController@EditGet');
		Route::post('/edit/', 'TopicController@EditPost');
		Route::get('/delete/{id}', 'TopicController@DeleteGet');
        Route::get('/', 'TopicController@AllGetForAdmin');
        Route::get('/{id}', 'TopicController@SingleGet');
	});

	// Message
	Route::group(['prefix' => '/message',], function ()
	{
		Route::get('/', 'MessageController@AllGet');
		Route::get('/delete/{id}', 'MessageController@DeleteGet');
	});

	// Course
	Route::group(['prefix' => '/course',], function ()
	{
		Route::get('/add', 'CourseController@AddGet');
		Route::post('/add', 'CourseController@AddPost');
		Route::get('/edit/{id}', 'CourseController@EditGet');
		Route::post('/edit', 'CourseController@EditPost');
		Route::get('/delete/{id}', 'CourseController@DeleteGet');
        Route::get('/', 'CourseController@AllGetForAdmin');
	});

    // I3class
    Route::group(['prefix' => '/i3class',], function ()
    {
        Route::get('/add', 'I3classController@AddGet');
        Route::post('/add', 'I3classController@AddPost');
        Route::get('/edit/{id}', 'I3classController@EditGet');
        Route::post('/edit', 'I3classController@EditPost');
        Route::get('/delete/{id}', 'I3classController@DeleteGet');
        Route::get('/change_state/{state}/{id}', 'I3classController@ChangeStateGet');
          Route::get('/', 'I3classController@AllGetForAdmin');
    });

    // ICDL
    Route::group(['prefix' => '/icdl',], function ()
    {
        Route::get('/i3class', 'I3classController@AllICDLGetForAdmin');

        Route::get('/test', 'IcdlTestController@AllGetForAdmin');
        Route::post('/test/edit', 'IcdlTestController@EditPost');
    });

	// Teacher
	Route::group(['prefix' => '/teacher',], function ()
	{
		Route::get('/add', 'TeacherController@AddGet');
		Route::post('/add', 'TeacherController@AddPost');
		Route::get('/edit/{id}', 'TeacherController@EditGet');
		Route::post('/edit', 'TeacherController@EditPost');
		Route::get('/delete/{id}', 'TeacherController@DeleteGet');
        Route::get('/', 'TeacherController@AllGetForAdmin');
	});

    // Employee
    Route::group(['prefix' => '/employee',], function ()
    {
        Route::get('/add', 'EmployeeController@AddGet');
        Route::post('/add', 'EmployeeController@AddPost');
        Route::get('/edit/{id}', 'EmployeeController@EditGet');
        Route::post('/edit', 'EmployeeController@EditPost');
        Route::get('/delete/{id}', 'EmployeeController@DeleteGet');
        Route::get('/', 'EmployeeController@AllGetForAdmin');
    });

	// Student
	Route::group(['prefix' => '/student',], function () {
		Route::get('/add', 'StudentController@AddGet');
		Route::post('/add', 'StudentController@AddPost');
		Route::get('/edit/{id}', 'StudentController@EditGet');
		Route::post('/edit', 'StudentController@EditPost');
		Route::get('/delete/{id}', 'StudentController@DeleteGet');
        Route::get('/', 'StudentController@AllGet');
        Route::get('/{id}', 'StudentController@SingleGet');
	});

	// Degree
	Route::group(['prefix' => '/degree',], function () {

		Route::get('/', 'DegreeController@AllGet');
		Route::post('/add', 'DegreeController@AddPost');
		Route::post('/edit', 'DegreeController@EditPost');
		Route::get('/delete/{id}', 'DegreeController@DeleteGet');
	});

	// Classroom
	Route::group(['prefix' => '/classroom',], function ()
    {
		Route::get('/', 'ClassroomController@AllGet');
		Route::post('/add', 'ClassroomController@AddPost');
		Route::post('/edit', 'ClassroomController@EditPost');
		Route::get('/delete/{id}', 'ClassroomController@DeleteGet');
	});

    // Group
    Route::group(['prefix' => '/group',], function ()
    {
        Route::get('/', 'GroupController@AllGet');
        Route::post('/add', 'GroupController@AddPost');
        Route::post('/edit', 'GroupController@EditPost');
        Route::get('/delete/{id}', 'GroupController@DeleteGet');
    });

    // Admin
    Route::group(['prefix' => '/admin',], function ()
    {
        Route::get('/add', 'AdminController@AddGet');
        Route::post('/add', 'AdminController@AddPost');
        Route::get('/edit/{id}', 'AdminController@EditGet');
        Route::post('/edit', 'AdminController@EditPost');
        Route::get('/delete/{id}', 'AdminController@DeleteGet');
        Route::get('/', 'AdminController@AllGet');
    });

	// Information
	Route::group(['prefix' => '/information',], function ()
    {
		Route::get('/', 'InformationController@AllGet');
        Route::get('/add', 'InformationController@AddGet');
		Route::post('/add', 'InformationController@AddPost');
        Route::get('/edit/{id}', 'InformationController@EditGet');
		Route::post('/edit', 'InformationController@EditPost');
		Route::get('/delete/{id}','InformationController@DeleteGet');
	});

    // Regulation
    Route::group(['prefix' => '/regulation',], function ()
    {
        Route::get('/', 'RegulationController@AllGetForAdmin');
        Route::get('/add', 'RegulationController@AddGet');
        Route::post('/add', 'RegulationController@AddPost');
        Route::get('/edit/{id}', 'RegulationController@EditGet');
        Route::post('/edit', 'RegulationController@EditPost');
        Route::get('/delete/{id}','RegulationController@DeleteGet');
    });
    
    // Off
    Route::group(['prefix' => '/off',], function ()
    {
        Route::get('/', 'OffController@AllGetForAdmin');
        Route::post('/add', 'OffController@AddPost');
        Route::post('/edit', 'OffController@EditPost');
        Route::get('/delete/{id}','OffController@DeleteGet');
    });

    // Menu
    Route::group(['prefix' => '/menu',], function ()
    {
        Route::get('/', 'MenuController@AllGet');
        Route::get('/add', 'MenuController@AddGet');
        Route::post('/add', 'MenuController@AddPost');
        Route::get('/edit/{id}', 'MenuController@EditGet');
        Route::post('/edit', 'MenuController@EditPost');
        Route::get('/delete/{id}','MenuController@DeleteGet');
    });

    // Social Network
    Route::group(['prefix' => '/social_network',], function ()
    {
        Route::get('/', 'SocialNetworkController@AllGet');
        Route::post('/add', 'SocialNetworkController@AddPost');
        Route::post('/edit', 'SocialNetworkController@EditPost');
        Route::get('/delete/{id}','SocialNetworkController@DeleteGet');
    });

	// Slider
	Route::group(['prefix' => '/slider'], function ()
    {
		Route::get('/', 'SliderController@AllGet');
		Route::get('/add', 'SliderController@AddGet');
		Route::post('/add', 'SliderController@AddPost');
		Route::get('/edit/{id}', 'SliderController@EditGet');
		Route::post('/edit', 'SliderController@EditPost');
		Route::get('/delete/{id}', 'SliderController@DeleteGet');
	});
	
    // Validity
    Route::group(['prefix' => '/validity'], function ()
    {
        Route::get('/', 'ValidityController@AllGet');
        Route::get('/add', 'ValidityController@AddGet');
        Route::post('/add', 'ValidityController@AddPost');
        Route::get('/edit/{id}', 'ValidityController@EditGet');
        Route::post('/edit', 'ValidityController@EditPost');
        Route::get('/delete/{id}', 'ValidityController@DeleteGet');
    });
    
    // Image
    Route::group(['prefix' => '/image'], function ()
    {
        Route::get('/', 'ImageController@AllGet');
        Route::get('/edit/{id}', 'ImageController@EditGet');
        Route::post('/edit', 'ImageController@EditPost');
    });
});