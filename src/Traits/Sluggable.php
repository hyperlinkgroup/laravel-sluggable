<?php

namespace Hyperlink\Sluggable\Traits;

use Hyperlink\Sluggable\Exceptions\ConfigModelMissing;
use Hyperlink\Sluggable\Exceptions\ConfigModelWrong;
use Hyperlink\Sluggable\Exceptions\SlugCreatedFromMissing;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait Sluggable
{
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

        if (! is_a(config('sluggable.model'), Model::class, true)) {
            throw new ConfigModelWrong(config('sluggable.model'));
        }

        static::created(fn (Model $model) => $model->sluggableCreated());

        static::updated(fn (Model $model) => $model->sluggableUpdated());
    }

    protected function sluggableCreated(): void
    {
        if (! $this->getSlugAutoGeneration()) {
            return;
        }

        $this->slugs()->create([
            'slug' => $this->makeSlug(),
        ]);
    }

    protected function sluggableUpdated(): void
    {
        if (! $this->getSlugAutoGeneration()) {
            return;
        }

        if ($this->isDirty($this->getSlugCreatedFrom())) {
            $this->slugs()->create([
                'slug' => $this->makeSlug(),
            ]);
        }
    }

    /**
     * @throws SlugCreatedFromMissing
     */
    protected function makeSlug(): string
    {
        return (string) sluggable($this->{$this->getSlugCreatedFrom()});
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
            get: fn () => $this->latestSlug?->slug,
            set: fn ($value) => $this->slugs()->create(['slug' => $value])
        );
    }

    public function slugHistory(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->slugs()->latest()->get()->pluck('slug'),
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

    /**
     * @throws SlugCreatedFromMissing
     */
    public function getSlugCreatedFrom(): string
    {
        if (! isset($this->slugCreatedFrom)) {
            throw new SlugCreatedFromMissing($this);
        }

        return $this->slugCreatedFrom;
    }

    public function getSlugAutoGeneration(): bool
    {
        return $this->slugAutoGeneration ?? true;
    }
}
