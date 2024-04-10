<?php

namespace Lumina\Tickets\Tests\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Lumina\Tickets\Models\Category;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
