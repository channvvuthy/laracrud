<?php

use App\Http\Controllers\admin\MenuController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CountryController;
use App\Http\Controllers\admin\ProvinceController;
use App\Http\Controllers\admin\ImageController;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\admin\CourseController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/upload', function () {
    return request()->file('file')->store(
        'images',
        'ocean'
    );
});

Route::group([
    'prefix' => '/auth',
], function () {

    // Login
    Route::get('/', [LoginController::class, 'index'])->middleware('guest')->name('login');
    Route::post('/login', [LoginController::class, 'authentication']);
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

    // Image
    Route::get('/image', [ImageController::class, 'getIndex']);
    Route::get('image/add', [ImageController::class, 'getAdd']);
    Route::post('image/post', [ImageController::class, 'postAdd']);

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

});
