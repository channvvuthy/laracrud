<?php

use App\Http\Controllers\admin\MenuController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CountryController;
use App\Http\Controllers\admin\ProvinceController;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\admin\CourseController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\CategoryController;

Route::group([
    'prefix' => '/auth',
], function () {

    // Login
    Route::get('/', [LoginController::class, 'index'])->middleware('guest')->name('login');
    Route::post('/login', [LoginController::class, 'authentication']);
    Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth');
});

Route::group([
    'prefix' => '/admin',
    'as' => 'admin',
    'middleware' => 'auth'
], function () {
    Route::get('/', [AdminController::class, 'getIndex']);
    Route::get('add', [AdminController::class, 'getAdd']);
    Route::get('edit/{id}', [AdminController::class, 'getEdit']);
    Route::post('post', [AdminController::class, 'postAdd']);
    Route::post('update', [AdminController::class, 'update']);
    Route::get('detail/{id}', [AdminController::class, 'detail']);
    Route::get('delete/{id}', [AdminController::class, 'delete']);

    // Country
    Route::get('/country', [CountryController::class, 'getIndex']);
    Route::get('country/add', [CountryController::class, 'getAdd']);
    Route::get('country/edit/{id}', [CountryController::class, 'getEdit']);
    Route::post('country/post', [CountryController::class, 'postAdd']);
    Route::post('country/update', [CountryController::class, 'update']);
    Route::get('country/detail/{id}', [CountryController::class, 'detail']);
    Route::get('country/delete/{id}', [CountryController::class, 'delete']);

    // Province
    Route::get('/province', [ProvinceController::class, 'getIndex']);
    Route::get('province/add', [ProvinceController::class, 'getAdd']);
    Route::get('province/edit/{id}', [ProvinceController::class, 'getEdit']);
    Route::post('province/post', [ProvinceController::class, 'postAdd']);
    Route::post('province/update', [ProvinceController::class, 'update']);
    Route::get('province/detail/{id}', [ProvinceController::class, 'detail']);
    Route::get('province/delete/{id}', [ProvinceController::class, 'delete']);

    // Province
    Route::get('/menu', [MenuController::class, 'getIndex']);
    Route::get('menu/add', [MenuController::class, 'getAdd']);
    Route::get('menu/edit/{id}', [MenuController::class, 'getEdit']);
    Route::post('menu/post', [MenuController::class, 'postAdd']);
    Route::post('menu/update', [MenuController::class, 'update']);
    Route::get('menu/detail/{id}', [MenuController::class, 'detail']);
    Route::get('menu/delete/{id}', [MenuController::class, 'delete']);

    // Course
    Route::get('course', [CourseController::class, 'getIndex']);
    Route::get('course/add', [CourseController::class, 'getAdd']);
    Route::post('course/post', [CourseController::class, 'postAdd']);
    Route::get('course/detail/{id}', [CourseController::class, 'detail']);
    Route::get('course/edit/{id}', [CourseController::class, 'getEdit']);
    Route::post('course/update', [CourseController::class, 'update']);

    // Setting
    Route::get('setting', [SettingController::class, 'getIndex']);
    Route::get('setting/add', [SettingController::class, 'getAdd']);
    Route::post('setting/post', [SettingController::class, 'postAdd']);
    Route::get('setting/detail/{id}', [SettingController::class, 'detail']);
    Route::get('setting/edit/{id}', [SettingController::class, 'getEdit']);
    Route::post('setting/update', [SettingController::class, 'update']);

    // Role
    Route::get('role', [RoleController::class, 'getIndex']);
    Route::get('role/add', [RoleController::class, 'getAdd']);
    Route::post('role/post', [RoleController::class, 'postAdd']);
    Route::get('role/detail/{id}', [RoleController::class, 'detail']);
    Route::get('role/edit/{id}', [RoleController::class, 'getEdit']);
    Route::post('role/update', [RoleController::class, 'update']);
    Route::get('role/assign_permission/{id}', [RoleController::class, 'assignPermission']);
    Route::post('role/assign_permission', [RoleController::class, 'postAssignPermission']);

    // Permission
    Route::get('permission', [PermissionController::class, 'getIndex']);
    Route::get('permission/add', [PermissionController::class, 'getAdd']);
    Route::post('permission/post', [PermissionController::class, 'postAdd']);
    Route::get('permission/detail/{id}', [PermissionController::class, 'detail']);
    Route::get('permission/edit/{id}', [PermissionController::class, 'getEdit']);
    Route::post('permission/update', [PermissionController::class, 'update']);

    // User
    Route::get('user', [UserController::class, 'getIndex']);
    Route::get('user/add', [UserController::class, 'getAdd']);
    Route::post('user/post', [UserController::class, 'postAdd']);
    Route::get('user/detail/{id}', [UserController::class, 'detail']);
    Route::get('user/edit/{id}', [UserController::class, 'getEdit']);
    Route::post('user/update', [UserController::class, 'update']);

    // Slider
    Route::get('slider', [SliderController::class, 'getIndex']);
    Route::get('slider/add', [SliderController::class, 'getAdd']);
    Route::post('slider/post', [SliderController::class, 'postAdd']);
    Route::get('slider/detail/{id}', [SliderController::class, 'detail']);
    Route::get('slider/edit/{id}', [SliderController::class, 'getEdit']);
    Route::post('slider/update', [SliderController::class, 'update']);

    // Category
    Route::get('category', [CategoryController::class, 'getIndex']);
    Route::get('category/add', [CategoryController::class, 'getAdd']);
    Route::post('category/post', [CategoryController::class, 'postAdd']);
    Route::get('category/detail/{id}', [CategoryController::class, 'detail']);
    Route::get('category/edit/{id}', [CategoryController::class, 'getEdit']);
    Route::post('category/update', [CategoryController::class, 'update']);

});
