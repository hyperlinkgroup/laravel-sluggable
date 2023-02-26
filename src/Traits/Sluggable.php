<?php

namespace Hyperlink\Sluggable\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait Sluggable {
    public function slugs(): MorphMany
    {
        return $this->morphMany(config('sluggable.model'), 'sluggable');
    }

    public function latestSlug(): MorphOne
    {
        return $this->morphOne(config('sluggable.model'), 'sluggable')->latestOfMany();
    }

    public function slug(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->latestSlug->slug,
            set: fn ($value) => $this->slugs()->create(['slug' => $value])
        );
    }

    public function slugHistory(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->slugs()->latest()->get()->pluck('slug')->toArray(),
        );
    }
}
