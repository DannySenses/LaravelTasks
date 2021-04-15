<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
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

    public function newTask( Request $request )
    {

        $validator = Validator::make( $request->all(), [
            "task_description" => "required|max:555"
        ]);

        if ( $validator->fails() )
            return redirect( "/" )->withInput()->withErrors( $validator );

        $task = new Task;
        $task->description = $request->task_description;
        $task->save();

        return redirect( "/" );

    }

    public function assignTask( Int $task_id )
    {

        Task::assign( $task_id );

        return redirect( "/" );

    }

    public function undoAssignTask( Int $task_id )
    {

        Task::unassign( $task_id );

        return redirect( "/" );

    }

}
