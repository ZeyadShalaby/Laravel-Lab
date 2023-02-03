<?php

namespace Database\Factories;

use App\Models\Post;

use Illuminate\Database\Eloquent\Factories\Factory;



class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {


        $faker = fake('en-US');

        return [
        
            'comment' => $faker->realTextBetween(500, 3000),
            'commentable_type' => Post::class,
            'commentable_id' => $faker->numberBetween(1, 1000),
            'user_id' => $faker->numberBetween(3, 50),
        ];
    }
}