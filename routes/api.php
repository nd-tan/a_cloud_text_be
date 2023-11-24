<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('contractor', App\Http\Controllers\ContractorController::class);
Route::get('contractor-all',[App\Http\Controllers\GroupController::class,"contractorAll"]);
Route::get('contractor-group',[App\Http\Controllers\GroupController::class,"contractorGroup"]);
Route::resource('group', App\Http\Controllers\GroupController::class);
Route::resource('sensor', App\Http\Controllers\SensorController::class);
Route::resource('access-right', App\Http\Controllers\AccessRightController::class);
Route::resource('account', App\Http\Controllers\UserController::class);
Route::resource('alert', App\Http\Controllers\AlertController::class);

Route::get('device-all',[App\Http\Controllers\AlertController::class,"getDataTree"]);
Route::resource('condition', App\Http\Controllers\ConditionController::class);
