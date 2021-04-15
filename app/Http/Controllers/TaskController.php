<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{

    public function index()
    {

        return view( "tasks", [
            "incomplete_tasks" => Task::getAllNotStarted(),
            "in_progress_tasks" => Task::getAllInProgress(),
            "completed_tasks" => Task::getAllCompleted()
        ]);

    }

    public function new( Request $request )
    {

        $validator = Validator::make( $request->all(), [
            "task_description" => "required|max:555"
        ]);

        if ( $validator->fails() )
            return redirect( "/" )->withInput()->withErrors( $validator );

        $task = new Task;
        $task->description = $request->task_description;
        $task->save();

        Cache::forget( "unassigned_tasks" );

        return redirect( "/" );

    }

    public function delete( Task $task )
    {

        $task->delete();

        Cache::forget( "tasks_in_progress" );
        Cache::forget( "unassigned_tasks" );
        Cache::forget( "completed_tasks" );

        return redirect( "/" );

    }

    public function assign( Task $task )
    {

        $task->update( [ "in_progress" => true ] );

        Cache::forget( "tasks_in_progress" );
        Cache::forget( "unassigned_tasks" );

        return redirect( "/" );

    }

    public function unassign( Task $task )
    {

        $task->update( [ "in_progress" => false ] );

        Cache::forget( "tasks_in_progress" );
        Cache::forget( "unassigned_tasks" );

        return redirect( "/" );

    }

    public function complete( Task $task )
    {

        $task->complete();

        return redirect( "/" );

    }

}
