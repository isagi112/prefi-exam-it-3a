<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/students', [StudentController::class, 'index']);
Route::get('/students/{id}', [StudentController::class, 'select']);
Route::post('/students', [StudentController::class, 'create']);
Route::patch('/students/{id}', [StudentController::class, 'update']);

Route::get('/students/{id}/subjects', [StudentController::class, 'sub_index']);
Route::get('/students/{id}/subjects/{subject_id}', [StudentController::class, 'select_both']);
Route::post('/students', [StudentController::class, 'create']);
Route::patch('/students/{id}', [StudentController::class, 'update']);