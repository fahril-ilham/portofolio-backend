<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->words(2, true) . ' App',
            'description' => $this->faker->paragraph() . ' Project untuk portofolio pribadi.',
            'tech_stack' => $this->faker->randomElement([
                'Laravel, MySQL',
                'HTML, CSS, JS',
                'Laravel, REST API',
                'PHP, Bootstrap',
                'React, Laravel API'
            ]),
        ];
    }
}
