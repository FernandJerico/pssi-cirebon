<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coach>
 */
class CoachFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'slug' => $this->faker->slug(),
            'position' => 'Kepala Pelatih',
            'phone_number' => $this->faker->e164PhoneNumber(),
            'team_id'=> $this->faker->numberBetween(1,18),
        ];
    }
}