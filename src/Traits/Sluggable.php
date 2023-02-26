<?php

namespace Hyperlink\Sluggable\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Sluggable {
    public function slugs(): MorphMany
    {
        return $this->morphMany(config('sluggable.model'), 'sluggable');
    }
}
