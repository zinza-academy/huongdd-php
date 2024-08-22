<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Config;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->name(),
            'description' => fake()->text(300),
            'status' => Config::get('constants.POST_STATUS_NOTRESOLVED'),
            'user_id' => User::inRandomOrder()->first()->id,
            'pinned' => fake()->randomElement([true, false]),
        ];
    }
}
