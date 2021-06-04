<?php

namespace App\tests\Unit;

use Tests\TestCase;
use App\API\MovieAPI;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MovieAPITest extends TestCase
{
    /** @test */
    public function can_retrieve_movie_data()
    {
        $movieAPI = new MovieAPI(config('services.movie_api.key'));

        $response = $movieAPI->getMoviesByTitle('Matrix');

        $this->assertIsArray($response->json());
        $this->assertNotEmpty($response->json());
        $this->assertEquals(true, $response->successful());
    }
}
