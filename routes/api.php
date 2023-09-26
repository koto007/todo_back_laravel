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
Route::get('tasks', 'App\Http\Controllers\Api\TaskController@index');
Route::post('tasks', 'App\Http\Controllers\Api\TaskController@register');
Route::patch('tasks/label/{id}', 'App\Http\Controllers\Api\TaskController@updateLabel');
Route::patch('tasks/status/{id}', 'App\Http\Controllers\Api\TaskController@updateStatus');
Route::delete('tasks/{id}', 'App\Http\Controllers\Api\TaskController@delete');
Route::get('statuses', 'App\Http\Controllers\Api\StatusController@index');