<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

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

    public function delete( Task $task )
    {

        $task->delete();

        return redirect( "/" );

    }

    public function assign( Task $task )
    {

        $task->update( [ "in_progress" => true ] );

        return redirect( "/" );

    }

    public function unassign( Task $task )
    {

        $task->update( [ "in_progress" => false ] );

        return redirect( "/" );

    }

    public function complete( Task $task )
    {

        $task->update( [ "completed" => 1, "completed_at" => Carbon::now() ]);

        return redirect( "/" );

    }

}
