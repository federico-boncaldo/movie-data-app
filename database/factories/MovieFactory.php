<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Movie::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'year' => $this->faker->year(),
            'imdb_id' => $this->faker->unique()->numerify('tt####'),
            'type' => $this->faker->randomElement(['movie', 'game'])
        ];
    }

    /**
     * Create movie with the same imdb_id
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function sameImdbID()
    {
        return $this->state(function (array $attributes) {
            return [
                'imdb_id' => '1234abc',
            ];
        });
    }
}
