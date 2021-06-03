<?php

namespace App\tests\Feature;

use Tests\TestCase;
use App\Models\Movie;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MovieTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function cannot_be_duplicated()
    {
        Movie::factory()->count(2)->sameImdbID()->create();

        $this->fail('Two movies have the same id');
    }
}
