<?php

namespace Hyperlink\Sluggable;

use Illuminate\Support\Str;

class Sluggable
{
    protected string $separator = '-';

    protected string $counterSeparator = '_';

    protected int $max_length = 255;

    protected string $text = '';

    public function __construct(string $text = '')
    {
        $this->text = $text;
        $this->reloadConfig();
    }

    private function reloadConfig(): void
    {
        $this->separator = config('sluggable.separator', '-');
        $this->counterSeparator = config('sluggable.counter_separator', '_');
        $this->max_length = config('sluggable.max_length', 255);
    }

    public function withSeparator(string $separator): self
    {
        $this->separator = $separator;

        return $this;
    }

    public function withCounterSeparator(string $counterSeparator): self
    {
        $this->counterSeparator = $counterSeparator;

        return $this;
    }

    public function withMaxLength(int $max_length): self
    {
        $this->max_length = $max_length;

        return $this;
    }

    public function slugify(string $text = ''): string
    {
        if (Str::length($text) > 0) {
            $this->text = $text;
        }
        if (Str::length($this->text) === 0) {
            return '';
        }

        $string = Str::slug($this->text, $this->separator);
        $string = Str::substr($string, 0, $this->max_length);

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

        $this->reloadConfig();

        return $string;
    }

    public function __toString(): string
    {
        return $this->slugify();
    }

    public function toString(string $text = ''): string
    {
        return $this->slugify($text);
    }

    public function get(string $text = ''): string
    {
        return $this->slugify($text);
    }
}
