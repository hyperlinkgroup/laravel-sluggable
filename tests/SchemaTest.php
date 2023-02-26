<?php

use Hyperlink\Sluggable\Models\Slug;
use Hyperlink\Sluggable\Tests\Models\Post;

it('can link slugs with the trait', function () {
    $post = Post::create([
        'title' => 'Test Title',
    ]);

    Slug::create([
        config('sluggable.column') => 'test-slug',
        'sluggable_id' => $post->id,
        'sluggable_type' => Post::class,
    ]);

    expect($post->slugs()->count())->toBe(1);
});
