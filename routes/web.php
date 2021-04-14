<?php

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

Route::get( "/", function(){

    return view( "tasks" );

})->name( "home" );

Route::post( "/create-task", function( Request $request ){

    $validator = Validator::make( $request->all(), [
        "task_description" => "required|max:555"
    ]);

    if ( $validator->fails() ) {

        return redirect( "/" )->withInput()->withErrors( $validator );

    }

});
