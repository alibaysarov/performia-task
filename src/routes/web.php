<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use \App\Http\Controllers\TodosController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[IndexController::class,'index'])->name('home');
Route::get('/login',[IndexController::class,'login'])->name('login');
Route::get('/todos/all',[TodosController::class,'getAll'])->name('todos');
Route::post('/todos/new',[TodosController::class,'addTodo']);
Route::put('/todos/update/{id}',[TodosController::class,'updateTodo']);
Route::delete('/todos/remove/{id}',[TodosController::class,'removeTodo']);
