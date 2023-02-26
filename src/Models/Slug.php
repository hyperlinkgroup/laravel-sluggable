<?php

namespace Hyperlink\Sluggable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Slug extends Model
{
    public function getFillable(): array
    {
        return [
            'sluggable_id',
            'sluggable_type',
            config('sluggable.column'),
        ];
    }

    public function sluggable(): MorphTo
    {
        return $this->morphTo();
    }
}
