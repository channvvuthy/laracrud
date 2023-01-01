<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;

Route::get('/', function () {
    return view('admincrud.index');
});

Route::group([
    'prefix' => '/admin',
    'as' => 'admin',
], function () {
    Route::get('/', [AdminController::class, 'getIndex']);
    Route::get('add', [AdminController::class, 'getAdd']);
    Route::get('edit/{id}', [AdminController::class, 'getEdit']);
    Route::post('post', [AdminController::class, 'postAdd']);
    Route::post('update', [AdminController::class, 'update']);
    Route::get('detail/{id}', [AdminController::class, 'detail']);
    Route::get('delete/{id}', [AdminController::class, 'delete']);
});
