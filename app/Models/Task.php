<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Cache;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        "completed",
        "completed_at",
        "in_progress"
    ];

    public static function getAllCompleted()
    {

        return cache()->remember( "completed_tasks", 3600, function(){

            return Task::where( "completed", true )->orderBy( "completed_at", "desc" )->get();

        });

    }

    public static function getAllInProgress()
    {

        return cache()->remember( "tasks_in_progress", 3600, function(){

            return Task::where( "in_progress", !null )->where( "completed", false )->latest()->get();

        });

    }

    public static function getAllNotStarted()
    {

        return cache()->remember( "unassigned_tasks", 3600, function(){

            return Task::where("completed", false)->where("in_progress", false)->orWhereNull("in_progress")->latest()->get();

        });

    }

    public function complete() : bool
    {

        Cache::clear( [ "tasks_in_progress", "completed_tasks" ] );

        return $this->update( [ "completed" => 1, "completed_at" => Carbon::now() ]);

    }

    public function unassign() : bool
    {

        Cache::clear( [ "tasks_in_progress", "unassigned_tasks" ] );

        return $this->update( [ "in_progress" => false ] );

    }

    public function assign() : bool
    {

        Cache::clear( [ "tasks_in_progress", "unassigned_tasks" ] );

        return $this->update( [ "in_progress" => true ] );

    }

}
