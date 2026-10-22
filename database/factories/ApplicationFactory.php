<?php

namespace Database\Factories;

use App\Models\Application;
use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $departments = Department::query()->get();

        return [
            'title' => fake()->title(),
            'description' => fake()->text(20),
            'user_id' => User::factory(),
            'department_id' =>  $departments->random()->id,
        ];
    }
}
