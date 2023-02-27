<?php

use Hyperlink\Sluggable\Sluggable;

if (! function_exists('slugify')) {
    function slugify($text): string
    {
        return app(Sluggable::class)->slugify($text);
    }
}

if (! function_exists('sluggable')) {
    function sluggable(string $text = ''): Sluggable
    {
        return app(Sluggable::class, ['text' => $text]);
    }
}
