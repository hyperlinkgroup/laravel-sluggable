<?php

namespace Hyperlink\Sluggable\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Hyperlink\Sluggable\Sluggable
 */
class Sluggable extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Hyperlink\Sluggable\Sluggable::class;
    }
}
