<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition()
    {
        $users = User::all()->pluck('id')->toArray();
        $category = Category::all()->pluck('id')->toArray();
        return [
            'user_id'       => $this->faker->randomElement($users),
            'category_id'   => $this->faker->randomElement($category),
            'post'          => $this->faker->sentence()
        ];
    }
}
