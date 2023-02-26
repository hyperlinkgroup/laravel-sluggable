<?php

namespace Hyperlink\Sluggable\Database\Factories;

use Hyperlink\Sluggable\Models\Slug;
use Illuminate\Database\Eloquent\Factories\Factory;

class SlugFactory extends Factory
{
    protected $model = Slug::class;

    public function definition(): array
    {
        return [
            'slug' => $this->faker->slug,
        ];
    }
}
