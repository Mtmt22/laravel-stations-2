<?php

namespace Database\Factories;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'title' => $this->faker->unique()->word,
            'title' => $this->faker->realText(10),
            'image_url' => $this->faker->imageUrl(),
            'published_year' => $this->faker->year(),
            'is_showing' => $this->faker->boolean,
            'description' => $this->faker->realText(20),
            // ランダムで取得する。idだけを渡す。
            'genre_id' => Genre::inRandomOrder()->first()->id,
        ];
    }
}
