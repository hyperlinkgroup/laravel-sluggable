<?php

namespace Hyperlink\Sluggable;

use Illuminate\Support\Str;

class Sluggable
{
    protected string $separator = '-';
    protected string $counterSeparator = '_';

    public function __construct()
    {
        $this->separator = config('sluggable.separator', '-');
        $this->counterSeparator = config('sluggable.counter_separator', '_');
    }

    public function slugify($text): string
    {
        $string = Str::slug($text, $this->separator);
        $string = Str::substr($string, 0, config('sluggable.max_length', 255));

        $i = 2;
        // WHILE the slug already exists
        while (config('sluggable.model')::where('slug', $string)->exists()) {
            // IF the counter is greater than 2
            if ($i > 2) {
                // THEN remove the previous number
                $string = Str::substr($string, 0, Str::length($string) - Str::length($i));
            } else {
                // ELSE add the separator
                $string .= $this->counterSeparator;
            }

            // FINALLY add the counter and increment it
            $string .= $i++;
        }

        return $string;
    }
}
