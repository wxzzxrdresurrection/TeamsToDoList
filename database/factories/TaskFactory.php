<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Task::class;

    public function definition(): array
    {
        return [
            Task::TITLE => fake()->sentence(),
            Task::BODY => fake()->paragraph(2),
            Task::RESPONSIBLE_ID => 1,
            Task::TEAM_ID => 1,
            Task::IS_COMPLETED => fake()->boolean(),
            Task::COMPLETED_AT => null,
            Task::CREATED_BY => 2,
        ];
    }

    public function completed(): TaskFactory
    {
        return $this->state(function (array $attributes) {
            return [
                Task::IS_COMPLETED => true,
                Task::COMPLETED_AT => now(),
            ];
        });
    }
}
