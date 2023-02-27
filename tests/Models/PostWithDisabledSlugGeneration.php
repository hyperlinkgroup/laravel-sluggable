<?php

namespace Hyperlink\Sluggable\Tests\Models;

use Hyperlink\Sluggable\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;

class PostWithDisabledSlugGeneration extends Model
{
    use Sluggable;

    protected string $slugCreatedFrom = 'title';

    protected bool $slugAutoGeneration = false;

    protected $table = 'posts';

    protected $fillable = [
        'title',
    ];
}
