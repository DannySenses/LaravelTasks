<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        "id"
    ];

    public static function getAllCompleted()
    {

        return Task::where( "completed" )->orderBy( "created_at", "desc" )->get();

    }

    public static function getAllInProgress()
    {

        return Task::where( "in_progress", !null )->where( "completed", false )->orderBy( "created_at", "desc" )->get();

    }

    public static function getAllNotStarted()
    {

        return Task::where( "completed", false )->where( "in_progress", false )->orWhereNull( "in_progress" )->orderBy( "created_at", "desc" )->get();

    }

    public function assign()
    {

        $this->update( ["in_progress" => true] );

    }

    public function unassign()
    {

        dd( $this->id );
        //$this->update( ["in_progress" => false] );

    }

    /*public static function unassign( Int $task_id )
    {

        return Task::where( "id", $task_id )->first()->update( [ "in_progress", false );
        //$task->in_progress = false;
        //$task->save();

    }*/

}
