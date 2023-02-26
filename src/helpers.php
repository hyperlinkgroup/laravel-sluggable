<?php

use Hyperlink\Sluggable\Sluggable;

if (! function_exists('slugify')) {
    function slugify($string): array|string|null
    {
        return app(Sluggable::class)->slugify($string);
    }
}
