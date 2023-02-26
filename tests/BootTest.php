<?php

use Hyperlink\Sluggable\Exceptions\ConfigModelMissing;
use Hyperlink\Sluggable\Exceptions\ConfigModelWrong;
use Hyperlink\Sluggable\Tests\Models\Post;

it('throws the correct exception if sluggable model is null', function () {
    config(['sluggable.model' => null]);

    Post::create(['title' => 'My First Post']);
})->throws(ConfigModelMissing::class);

it('throws the correct exception if sluggable model is not a string', function () {
    config(['sluggable.model' => 123]);

    Post::create(['title' => 'My First Post']);
})->throws(ConfigModelWrong::class);

it('throws the correct exception if sluggable model is not a valid class', function () {
    config(['sluggable.model' => 'Not\\A\\Class']);

    Post::create(['title' => 'My First Post']);
})->throws(ConfigModelWrong::class);
