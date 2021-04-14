<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

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

}
