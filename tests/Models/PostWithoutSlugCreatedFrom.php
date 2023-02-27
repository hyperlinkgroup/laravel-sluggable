<?php

namespace Hyperlink\Sluggable\Tests\Models;

use Hyperlink\Sluggable\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;

class PostWithoutSlugCreatedFrom extends Model
{
    use Sluggable;

    protected $table = 'posts';

    protected $fillable = [
        'title',
    ];
}
