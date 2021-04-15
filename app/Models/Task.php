<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

            return Task::where( "in_progress", !null )->where( "completed", false )->orderBy( "created_at", "desc" )->get();

        });

    }

    public static function getAllNotStarted()
    {

        return cache()->remember( "unassigned_tasks", 3600, function(){

            return Task::where("completed", false)->where("in_progress", false)->orWhereNull("in_progress")->orderBy("created_at", "desc")->get();

        });

    }

}
