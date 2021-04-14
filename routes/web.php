<?php

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

Route::get( "/", [ \App\Http\Controllers\TaskController::class, "showAll" ])->name( "home" );

Route::get( "/", function(){

    return view( "tasks", [
        "incomplete_tasks" => Task::where( "completed", false )->where( "in_progress", false )->orWhereNull( "in_progress" )->orderBy( "created_at", "desc" )->get(),
        "in_progress_tasks" => Task::where( "in_progress", !null )->orderBy( "created_at", "desc" )->get(),
        "completed_tasks" => Task::where( "completed" )->orderBy( "created_at", "desc" )->get()
    ]);

})->name( "home" );

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
