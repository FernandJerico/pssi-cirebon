<?php

namespace Database\Factories;

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
    public function definition()
    {
        return [
            'team_name' => fake()->name(),
            'slug' => $this->faker->slug(),
            'excerpt' => $this->faker->paragraph(),
            'description' => '<p>' . implode('</p><p>',$this->faker->paragraphs(mt_rand(5,10))) . '</p>',
            'category_id' => mt_rand(1,2),
        ];
    }
}