<?php

use App\Http\Controllers\API\AuthAPIController;
use App\Http\Controllers\API\ChurchAPIController;
use App\Http\Controllers\API\DuesAPIController;
use App\Http\Controllers\API\MemberAPIController;
use App\Http\Controllers\API\UserAPIController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthAPIController::class, 'login']);

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
    Route::post('refresh', [AuthAPIController::class, 'refresh']);
    Route::post('logout', [AuthAPIController::class, 'logout']);
});


Route::group([], function () {
    Route::resource('users', UserAPIController::class);
    Route::resource('churches', ChurchAPIController::class);
    Route::resource('members', MemberAPIController::class);
    Route::resource('dues', DuesAPIController::class);



});






