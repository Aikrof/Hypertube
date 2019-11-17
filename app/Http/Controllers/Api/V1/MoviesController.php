<?php

namespace App\Http\Controllers\Api\V1;

use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as GuzzleRequest;

class MoviesController extends Controller
{
	protected $client;

	function __construct()
	{
		$this->client = new Client();
	}

	public function getMovieById(Request $request, $id)
    {
        $url = 'https://yts.lt/api/v2/movie_details.json?with_images=true&with_cast=true&movie_id=' . $id;
        $response = $this->client->request('GET', $url);

        $movie = json_decode($response->getBody())->data->movie;

        $data = $this->getMovieData($movie, true);
        echo "<pre>";
        var_dump($movie);
        exit;
    }

	public function getMovies(Request $request)
	{
	    $url = 'https://yts.lt/api/v2/list_movies.json?limit=50&sort_by=year';
        $guzleRequest = $this->client->request('GET', $url);
        $movies = json_decode($guzleRequest->getBody())->data->movies;

        $data = [];

        foreach ($movies as $key => $movie){
            $data[$key] = $this->getMovieData($movie);

//var_dump($movie);exit;
//            $data[$key] = array_merge(
//                $data[$key],
//                $this->themovieDB($movie->imdb_code)
//            );
        }

	    return (
	        response()->json($data, 200)
        );
	}

	protected function getMovieData($movie, $withFullDesc = false)
    {
        return ([
            'movie_id' => $movie->id,
            'title' => $movie->title,
            'genres' => implode(', ' , $movie->genres),
            'description' => $withFullDesc ?
                $movie->description_full :
                mb_strimwidth(
                    $movie->description_full,
                    0,
                    120,
                    "..."
                ),
            'year' => $movie->year,
            'poster' => $movie->medium_cover_image,
            'rating' => $movie->rating
        ]);
    }

	protected function themovieDB(String $imdb_code)
    {
        $themoviedb = $this->client->request(
            'GET',
            'https://api.themoviedb.org/3/find/'
            . $imdb_code .
            '?api_key=23ba1f06e03c7d329913a75a4e15d0ea&external_source=imdb_id');
        $movieDb = json_decode($themoviedb->getBody());

        return ([
//            'year' => explode('-', $movieDb->release_date)[0],
//            'overview' => $movieDb->overview,
            'poster' => 'https://api.themoviedb.org/3' . $movieDb->poster_path,
            'popularity' => (string)$movieDb->popularity
        ]);
    }
}
