<?php

namespace App\API;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

class MovieAPI
{
    protected $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getMoviesByTitle(string $title): Response
    {
        return Http::get('http://www.omdbapi.com/', [
            's' => $title,
            'apiKey' => $this->apiKey,
        ]);
    }
}
