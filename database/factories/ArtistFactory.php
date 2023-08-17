<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artist>
 */
class ArtistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => fake()->name(),
            'genre_musical' => fake()->sentence(),
            'reseaux_sociaux' => fake()->url(),
            'biograhie' => fake()->text(),
            'est_utilisateur' => $val = fake()->numberBetween(0,1),
            'user_id' => $val == 1 ? User::factory() : null,
        ];
    }
}
