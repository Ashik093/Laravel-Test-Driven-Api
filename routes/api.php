<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TodoListController;

Route::get('/todo-list',[TodoListController::class,'index'])->name('todo.list.index');
Route::get('/single-todo-list/{todoList}',[TodoListController::class,'show'])->name('todo.list.show');
Route::post('/todo-list',[TodoListController::class,'store'])->name('todo.list.store');
Route::delete('/todo-list-delete/{list}',[TodoListController::class,'destroy'])->name('todo.list.destroy');
Route::patch('/todo-list-update/{list}',[TodoListController::class,'update'])->name('todo.list.update');
