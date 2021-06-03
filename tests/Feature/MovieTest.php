<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MovieTest extends TestCase
{

    /** @test */
    public function cannot_be_duplicated()
    {
        Movie::factory()->count(2)->sameImdbID()->create();

        $this->fail('Two movies have the same id');
    }
}
