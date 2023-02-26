<?php

namespace Hyperlink\Sluggable\Traits;

use Hyperlink\Sluggable\Exceptions\ConfigModelMissing;
use Hyperlink\Sluggable\Exceptions\ConfigModelWrong;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait Sluggable {
    /**
     * Boot the trait, check if the config is set and if the model is correct.
     *
     * @throws ConfigModelMissing
     * @throws ConfigModelWrong
     */
    public static function bootSluggable(): void
    {
        if (config('sluggable.model') === null) {
            throw new ConfigModelMissing();
        }

        if (!is_a(config('sluggable.model'), Model::class, true)) {
            throw new ConfigModelWrong();
        }

    }

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

    public function slugHistoryWithDates(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->slugs()->latest()->get()->map(fn ($slug) => [
                'slug' => $slug->slug,
                'created_at' => $slug->created_at,
            ]),
        );
    }
}
