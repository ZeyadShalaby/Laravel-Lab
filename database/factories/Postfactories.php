<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

 
class PostFactory extends Factory
{


    /**
     * @return array<string, mixed>
     */
    public function definition()
    {

        $faker = fake('en_US');

        return [
            'title' => $faker->text(50),
            'description' => $faker->realTextBetween(500, 3000),
            'user_id' => $faker->numberBetween(3, 50),
            'slug' => $faker->slug(4, true),
            'post_image' => null
        ];
    }
}