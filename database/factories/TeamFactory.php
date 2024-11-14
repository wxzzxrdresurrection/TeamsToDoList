<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Team::class;

    public function definition(): array
    {
        return [
            Team::NAME => fake()->name(),
            Team::OWNER_ID => 2,
            Team::DESCRIPTION => fake()->sentence(),
            Team::CODE => fake()->unique()->randomNumber(6 ,true),
        ];
    }
}
