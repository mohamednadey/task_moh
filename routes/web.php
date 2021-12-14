<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;



Route::get('/',[TaskController::class,'index']);
Route::post('/tasks', [TaskController::class, 'store']) ;
Route::post('delete/{id}',[TaskController::class,'delete']);
Route::put('edit/{id}',[TaskController::class,'edit']);
Route::patch('update/{id}',[TaskController::class,'update']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
