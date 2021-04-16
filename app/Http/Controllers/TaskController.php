<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Helpers\Cache;
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
            "description" => "required|max:555"
        ]);

        if ( $validator->fails() )
            return redirect( "/" )->withInput()->withErrors( $validator );

        $task = new Task;
        $task->description = $request->description;
        $task->save();

        Cache::forget( "unassigned_tasks" );

        return redirect( "/" );

    }

    public function delete( Task $task )
    {

        Cache::clear( [ "tasks_in_progress", "unassigned_tasks", "completed_tasks" ] );

        $task->delete();

        return redirect( "/" );

    }

    public function assign( Task $task )
    {

        $task->assign();

        return redirect( "/" );

    }

    public function unassign( Task $task )
    {

        $task->unassign();

        return redirect( "/" );

    }

    public function complete( Task $task )
    {

        $task->complete();

        return redirect( "/" );

    }

}
