<?php

namespace App\Helpers;

class Cache extends \Illuminate\Support\Facades\Cache
{

    public static function clear( Array $caches ) : bool
    {

        foreach( $caches as $cache )
        {

            parent::forget( $cache );

        }

        return true;

    }

}
