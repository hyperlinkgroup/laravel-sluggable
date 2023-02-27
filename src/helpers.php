<?php

use Hyperlink\Sluggable\Sluggable;

if (! function_exists('slugify')) {
    function slugify($string): string
    {
        return app(Sluggable::class)->slugify($string);
    }
}
