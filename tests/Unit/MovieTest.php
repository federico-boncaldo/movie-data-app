<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Movie;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MovieTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function cannot_be_duplicated()
    {
        $this->expectException(QueryException::class);

        Movie::factory()->count(2)->sameImdbID()->create();
    }

    public function has_a_poster()
    {
        $movie = Movie::factory()->create();
        $poster = new Poster();
        $poster->url = $this->faker->imageUrl('');

        $movie->poster();

        $this->assertEquals($movie->poster()->url, $poster->url);
    }
}
