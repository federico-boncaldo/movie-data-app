<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RetrieveMovieDataTest extends TestCase
{
    use WithFaker;
    /** @test */
    public function can_search_movie_by_title()
    {
        $title = $this->faker->word();

        $response = $this->get('/movies?title='. $title);

        $response
            ->assertStatus(200);
    }
}
