<?php

namespace AchyutN\LaravelHelpers\Tests\Factories;

use AchyutN\LaravelHelpers\Tests\Models\Approve;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApproveFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Approve::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
        ];
    }
}
