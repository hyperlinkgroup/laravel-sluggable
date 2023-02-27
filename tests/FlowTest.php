<?php

use Hyperlink\Sluggable\Exceptions\SlugCreatedFromMissing;
use Hyperlink\Sluggable\Tests\Models\Post;
use Hyperlink\Sluggable\Tests\Models\PostWithDisabledSlugGeneration;
use Hyperlink\Sluggable\Tests\Models\PostWithoutSlugCreatedFrom;

it('throws the correct exception if slugCreatedFrom is missing.', function () {
    $post = PostWithoutSlugCreatedFrom::create(['title' => 'My First Post']);

    $post->getSlugCreatedFrom();
})->throws(SlugCreatedFromMissing::class);

it('does not throw an exception if slugCreatedFrom is set.', function () {
    $post = Post::create(['title' => 'My First Post']);

    expect($post->getSlugCreatedFrom())->toBe('title');
});

it('does create a slug from the slugCreatedFrom attribute.', function () {
    $post = Post::create(['title' => 'My First Post']);

    expect($post->slug)->toBe('my-first-post');
});

it('does create a new slug from the slugCreatedFrom attribute when the value of the slugCreatedFrom attribute is updated.', function () {
    $post = Post::create(['title' => 'My First Post']);

    $post->update(['title' => 'My Second Post']);

    expect($post->slug)->toBe('my-second-post');
});

it('does not automatically create a slug when the slug generation is disabled', function () {
    $post = PostWithDisabledSlugGeneration::create(['title' => 'My First Post']);

    expect($post->slug)->toBeNull();
});
