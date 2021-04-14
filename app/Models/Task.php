<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public static function getAllCompleted()
    {

        return self::where( "completed" )->orderBy( "created_at", "desc" )->get();

    }

    public static function getAllInProgress()
    {

        return self::where( "in_progress", !null )->where( "completed", false )->orderBy( "created_at", "desc" )->get();

    }

    public static function getAllNotStarted()
    {

        return self::where( "completed", false )->where( "in_progress", false )->orWhereNull( "in_progress" )->orderBy( "created_at", "desc" )->get();

    }
}
