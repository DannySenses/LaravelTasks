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

    public function assign( Task $task )
    {

        $task->assign();

        return redirect( "/" );

    }

    public function undoAssignTask( Int $id )
    {

        Task::where( "id", $id )->get()->first()->unassign();

        return redirect( "/" );

    }

    public function deleteTask( Int $id )
    {

        Task::findOrFail( $id )->delete();

        return redirect( "/" );

    }

}
