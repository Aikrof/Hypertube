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

	public function movies(Request $request)
	{
	    $request = $this->client->request(
	        'GET',
            'https://yts.lt/api/v2/list_movies.json?sort_by=year'
        );
	    $movies = json_decode($request->getBody())->data->movies;

	    $data = [];

	    foreach ($movies as $movie){
	        var_dump($movie);
	        echo '--------------------- \n';
	        $this->themovieDB($movie->imdb_code);
	        exit;
        }

    	exit;
	}

	protected function themovieDB(String $imdb_code)
    {
        $themoviedb = $this->client->request(
            'GET',
            'https://api.themoviedb.org/3/find/'
            . $imdb_code .
            '?api_key=23ba1f06e03c7d329913a75a4e15d0ea&external_source=imdb_id');
        $movie_data = json_decode($themoviedb->getBody())->movie_results[0];
        echo "<pre>";
        var_dump($movie_data);
        exit;
    }
}
