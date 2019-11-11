<?php

namespace App\Http\Controllers\Api\V1;

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
		// $request = new GuzzleRequest('GET', 'https://api.themoviedb.org/3/find/tt4461676?api_key=23ba1f06e03c7d329913a75a4e15d0ea&external_source=imdb_id');
		// $promise = $this->client->sendAsync($request)
		// 	->then(function ($response){
		// 		echo "<pre>";
		// 		var_dump(json_decode($response->getBody()));
		// 		exit;

		// 	});
		// $promise->wait();

		// $client = new Client();

		$response = $this->client->request('GET', 'https://yts.lt/api/v2/list_movies.json?sort_by=year');
    	// var_dump((json_decode($response->getBody()))->data);
    	$movies = json_decode($response->getBody())->data->movies;
    	
    	foreach ($movies as $movie){
    		echo $movie->year . " ";
    		var_dump($movie->title);
    	}
    	exit;
	}
}
