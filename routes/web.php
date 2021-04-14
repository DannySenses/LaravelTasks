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

Route::post( "/create-task", function( Request $request ){

    $validator = Validator::make( $request->all(), [
        "task_description" => "required|max:555"
    ]);

    if ( $validator->fails() ) {

        return redirect( "/" )->withInput()->withErrors( $validator );

    }

    $task = new Task;
    $task->description = $request->task_description;
    $task->save();

    return redirect( "/" );

});
