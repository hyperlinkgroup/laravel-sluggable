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

it('always returns the latest slug', function () {
    $post = Post::create([
        'title' => 'Test Title',
    ]);

    Slug::create([
        config('sluggable.column') => 'test-slug',
        'sluggable_id' => $post->id,
        'sluggable_type' => Post::class,
    ]);

    Slug::create([
        config('sluggable.column') => 'test-slug-2',
        'sluggable_id' => $post->id,
        'sluggable_type' => Post::class,
    ]);

    expect($post->slugs()->count())->toBe(2);
    expect($post->slug)->toBe('test-slug-2');
});

it('can show the slug history', function () {
    $post = Post::create([
        'title' => 'Test Title',
    ]);

    Slug::create([
        config('sluggable.column') => 'test-slug',
        'sluggable_id' => $post->id,
        'sluggable_type' => Post::class,
    ]);

    Slug::create([
        config('sluggable.column') => 'test-slug-2',
        'sluggable_id' => $post->id,
        'sluggable_type' => Post::class,
    ]);

    expect($post->slugs()->count())->toBe(2);
    expect($post->slugHistory)->toBe([
        'test-slug',
        'test-slug-2',
    ]);
});
