<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MovieAPITest extends TestCase
{
    /** @test */
    public function can_retrieve_movie_data()
    {
        $movieAPI = new MovieAPI(config('services.movie_api.secret'));

        $results = $movieAPI->getMoviesByTitle('Matrix');

        $this->assertIsArray($results);
        $this->assertNotEmpty($results);
        $this->assertEquals(true, $results['Response']);
    }
}
