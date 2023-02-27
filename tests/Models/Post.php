<?php

namespace Hyperlink\Sluggable\Tests\Models;

use Hyperlink\Sluggable\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Sluggable;

    protected $fillable = [
        'title',
    ];
}
