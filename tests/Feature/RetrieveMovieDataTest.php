<?php

namespace App\tests\Feature;

use Tests\TestCase;
use App\Models\Movie;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RetrieveMovieDataTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /** @test */
    public function can_search_movie_by_title()
    {
        $title = $this->faker->word();

        $response = $this->get('/movies?title='. urlencode($title));

        $response
            ->assertStatus(200);
    }

    /** @test */
    public function stores_movies_when_data_are_fetched()
    {
        $title = 'Matrix';

        $response = $this->get('/movies?title='. urlencode($title));

        $response
            ->assertStatus(200);
        $this->assertGreaterThan(0, Movie::all()->count());
    }

    /** @test */
    public function returns_response_false_if_movie_not_found()
    {
        $title = 'Non existent movie';

        $response = $this->get('/movies?title='. urlencode($title));

        $response
            ->assertStatus(200)
            ->assertJson(['Response' => false]);
    }

    /** @test */
    public function returns_response_true_if_movie_found()
    {
        $title = 'Matrix';

        $response = $this->get('/movies?title='. urlencode($title));

        $response
            ->assertStatus(200)
            ->assertJson(['Response' => true]);
    }

    /** @test */
    public function stores_posters_when_present()
    {
        $title = 'Matrix';

        $response = $this->get('/movies?title='. urlencode($title));
        $movies = collect($response->json()['data'])->filter(function ($movie) {
            return ! empty($movie['Poster']) && $movie['Poster'] != 'N/A';
        });
        $movie = $movies->first();

        $response
            ->assertStatus(200);
        $this->assertEquals(
            $movie['Poster'],
            Movie::where('imdb_id', $movie['imdbID'])
                ->get()
                ->poster()->url
        );
    }
}
