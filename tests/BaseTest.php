<?php

use Illuminate\Support\Facades\Schema;

it('can test', function () {
    expect(true)->toBeTrue('true is not true');
});

it('can migrate', function () {
    $this->artisan('migrate');

    expect(Schema::hasTable('posts'))->toBeTrue('posts table does not exist');
});
