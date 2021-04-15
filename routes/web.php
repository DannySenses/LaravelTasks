<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

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

Route::post( "/create-task", [ TaskController::class, "new" ]);

Route::post( "/assign-task/{task}", [ TaskController::class, "assign" ]);

Route::post( "/unassign-task/{task}", [ TaskController::class, "unassign" ]);

Route::post( "/complete-task/{task}", [ TaskController::class, "complete" ]);

Route::delete( "/delete-task/{task}", [ TaskController::class, "delete" ]);
