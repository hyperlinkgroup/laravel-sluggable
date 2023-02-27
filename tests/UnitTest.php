<?php

use Hyperlink\Sluggable\Tests\Models\Post;

it('creates a slug from a string', function () {
    $text = 'This is a test';

    expect(slugify($text))->toBe('this-is-a-test');
});

it('creates a slug from a string with same slug already present', function () {
    config('sluggable.model')::create([
        'sluggable_id' => 1,
        'sluggable_type' => Post::class,
        'slug' => 'this-is-a-test',
    ]);

    $text = 'This is a test';

    expect(slugify($text))->toBe('this-is-a-test_2');

    config('sluggable.model')::create([
        'sluggable_id' => 1,
        'sluggable_type' => Post::class,
        'slug' => 'this-is-a-test_2',
    ]);

    expect(slugify($text))->toBe('this-is-a-test_3');

    config('sluggable.model')::create([
        'sluggable_id' => 1,
        'sluggable_type' => Post::class,
        'slug' => 'this-is-a-test_3',
    ]);

    expect(slugify($text))->toBe('this-is-a-test_4');
});

it('returns the same slug if the string is the same', function () {
    $text = 'This is a test';

    expect(slugify($text))->toBe('this-is-a-test');
    expect(slugify($text))->toBe('this-is-a-test');
});

it('creates a slug from a string with a custom separator', function () {
    config(['sluggable.separator' => '_']);
    $text = 'This is a test';

    expect(slugify($text))->toBe('this_is_a_test');
});

it('creates a slug from a string with a custom counter separator', function () {
    config(['sluggable.counter_separator' => '-']);

    config('sluggable.model')::create([
        'sluggable_id' => 1,
        'sluggable_type' => Post::class,
        'slug' => 'this-is-a-test',
    ]);

    $text = 'This is a test';

    expect(slugify($text))->toBe('this-is-a-test-2');
});

it('creates a slug from a string with a custom length', function () {
    config(['sluggable.max_length' => 5]);
    $text = 'This is a test';

    expect(slugify($text))->toBe('this-');
});
