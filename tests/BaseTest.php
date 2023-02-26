<?php

use Illuminate\Support\Facades\Schema;

it('can test', function () {
    expect(true)->toBeTrue('true is not true');
});

it('can migrate', function () {
    expect(Schema::hasTable('posts'))->toBeTrue('posts table does not exist');
    expect(Schema::hasTable('slugs'))->toBeTrue('slugs table does not exist');
});

it('can migrate with custom table name', function () {
    expect(Schema::hasTable('posts'))->toBeTrue('posts table does not exist');
    expect(Schema::hasTable('slugs'))->toBeTrue('slugs table does not exist');

    $this->artisan('migrate:fresh');

    // Getting the migration from the stub file and set a different table name
    $migration = include __DIR__.'/../database/migrations/create_sluggable_table.php.stub';
    config(['sluggable.table' => 'slugsTableWithCustomName']);

    $migration->up();

    expect(Schema::hasTable('posts'))->toBeTrue('posts table does not exist');
    expect(Schema::hasTable('slugsTableWithCustomName'))->toBeTrue('slugsTableWithCustomName table does not exist');
});

it('can migrate with custom table name and custom column name', function () {
    expect(Schema::hasTable('posts'))->toBeTrue('posts table does not exist');
    expect(Schema::hasTable('slugs'))->toBeTrue('slugs table does not exist');
    expect(Schema::hasColumn('slugs', 'slug'))->toBeTrue('slug column does not exist');

    $this->artisan('migrate:fresh');

    // Getting the migration from the stub file and set a different table name
    $migration = include __DIR__.'/../database/migrations/create_sluggable_table.php.stub';
    config(['sluggable.table' => 'slugsTableWithCustomName']);
    config(['sluggable.column' => 'slugColumnWithCustomName']);

    $migration->up();

    expect(Schema::hasTable('posts'))->toBeTrue('posts table does not exist');
    expect(Schema::hasTable('slugsTableWithCustomName'))->toBeTrue('slugsTableWithCustomName table does not exist');
    expect(Schema::hasColumn('slugsTableWithCustomName', 'slugColumnWithCustomName'))->toBeTrue('slugColumnWithCustomName column does not exist');
});
