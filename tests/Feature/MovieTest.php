<?php

namespace App\tests\Feature;

use Tests\TestCase;
use App\Models\Movie;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MovieTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function cannot_be_duplicated()
    {
        try {
            $movies = Movie::factory()->count(2)->sameImdbID()->create();
        } catch (QueryException $e) {
            $this->assertEquals(1, $movies->count());
        }

        $this->fail("It was possible two store two movies with the same imdb_id, even if it's not allowed");
    }
}
