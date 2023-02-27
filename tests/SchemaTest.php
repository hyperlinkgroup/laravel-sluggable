<?php

use Hyperlink\Sluggable\Models\Slug;
use Hyperlink\Sluggable\Tests\Models\Post;

it('can link slugs with the trait', function () {
    Post::withoutEvents(function () {
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
});

it('always returns the latest slug', function () {
    Post::withoutEvents(function () {
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
});

it('can show the slug history', function () {
    Post::withoutEvents(function () {
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
        expect(collect([
            'test-slug',
            'test-slug-2',
        ])->diff(collect($post->slugHistory))->isEmpty())->toBeTrue('The slug history is not the same');
    });
});

it('can show the slug history with dates', function () {
    Post::withoutEvents(function () {
        $post = Post::create([
            'title' => 'Test Title',
        ]);

        Slug::create([
            config('sluggable.column') => 'test-slug',
            'sluggable_id' => $post->id,
            'sluggable_type' => Post::class,
        ]);

        $this->travel(1)->minutes();

        Slug::create([
            config('sluggable.column') => 'test-slug-2',
            'sluggable_id' => $post->id,
            'sluggable_type' => Post::class,
        ]);

        expect($post->slugs()->count())->toBe(2);
        $post->slugHistoryWithDates->each(function ($slug) {
            expect($slug)->toHaveKeys([
                'slug',
                'created_at',
            ]);

            expect($slug['slug'])->toBeString();
            expect($slug['created_at'])->toBeInstanceOf(Carbon\Carbon::class);
        });
    });
});
