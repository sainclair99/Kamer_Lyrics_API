<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lyrics>
 */
class LyricsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titre' => fake()->name(),
            'contenu' => fake()->text(),
            'status' => fake()->word(),
            'date_sortie' => now(),
            'verifier' => fake()->numberBetween(0,1),
            'video' => fake()->url(),
            'user_id' => fake()->numberBetween(1,21)
        ];
    }
}
