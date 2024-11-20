<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/',[TodoController::class,'index'])->name('todo.index');
Route::post('/addTodo',[TodoController::class,'addTodo'])->name('todo.add');
Route::post('/todo-ready',[TodoController::class,'readyTask'])->name('todo.ready');
Route::delete('/deleteTodo/{id}', [TodoController::class, 'deleteTodo'])->name('todo.delete');
