<?php

use App\Http\Controllers\TaskController;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get( "/", [ TaskController::class, "index" ])->name( "home" );

Route::post( "/create-task", [ TaskController::class, "newTask" ]);

Route::post( "/assign-task/{task}", [ TaskController::class, "assign" ]);

Route::post( "/undo-assign-task/{id}", [ TaskController::class, "undoAssignTask" ]);

Route::delete( "/delete-task/{id}", [ TaskController::class, "deleteTask" ] );
