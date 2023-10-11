<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Player>
 */
class PlayerFactory extends Factory
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
            'place_birthdate' => $this->faker->dateTime(),
            'gender' => $this->faker->randomElement(['Laki-laki','Perempuan']),
            'position' => $this->faker->randomElement(['Bek Tengah','Bek Penyapu', 'Bek Kiri', 'Kiper']),
            'status' => $this->faker->randomElement(['Amatir','Profesional']),
            'team_id' => $this->faker->randomNumber(1,19),
        ];
    }
}