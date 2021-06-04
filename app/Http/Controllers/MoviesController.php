<?php

namespace App\Http\Controllers;

use App\API\MovieAPI;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class MoviesController extends Controller
{
    public function index(Request $request)
    {
        $values = $this->validate($request, [
            'title' => 'string'
        ]);

        $movieAPI = new MovieAPI(config('services.movie_api.key'));
        $response = $movieAPI->getMoviesByTitle($values['title']);

        if ($response->successful()) {
            $results = $response->json();
            foreach ($results['Search'] as $result) {
                try {
                    $movie = new Movie();
                    $movie->title = $result['Title'];
                    $movie->year = $result['Year'];
                    $movie->imdb_id = $result['imdbID'];
                    $movie->type = $result['Type'];
                    $movie->save();
                } catch (QueryException $e) {
                    Log::error($e);
                }
            }
            $data = Movie::all();
        } else {
            $data = 'Movie not found!';
        }

        return response($data, 200);
    }
}
