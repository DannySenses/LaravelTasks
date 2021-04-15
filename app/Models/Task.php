<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $primaryKey = "id";

    protected $fillable = [
        "completed",
        "completed_at",
        "in_progress"
    ];

    public static function getAllCompleted()
    {

        return Task::where( "completed", true )->orderBy( "completed_at", "desc" )->get();

    }

    public static function getAllInProgress()
    {

        return Task::where( "in_progress", !null )->where( "completed", false )->orderBy( "created_at", "desc" )->get();

    }

    public static function getAllNotStarted()
    {

        return Task::where("completed", false)->where("in_progress", false)->orWhereNull("in_progress")->orderBy("created_at", "desc")->get();

    }

}
