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
        
        $data = $this->getCommonMovieData($movie, true);
        $data = array_merge(
            $this->getCommonMovieData($movie, true),
            $this->getIndividualMovieData($movie)
        );

        return (response()->json($data, 200));
    }

	public function getMovies(Request $request)
	{
	    $url = 'https://yts.lt/api/v2/list_movies.json?limit=50&sort_by=year';
        $guzleRequest = $this->client->request('GET', $url);
        $movies = json_decode($guzleRequest->getBody())->data->movies;

        $data = [];

        foreach ($movies as $key => $movie){
            $data[$key] = $this->getCommonMovieData($movie);

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

	protected function getCommonMovieData($movie, $withFullDesc = false)
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

    protected function getIndividualMovieData($movie)
    {
        $screenshots = [
            $movie->medium_screenshot_image1,
            $movie->medium_screenshot_image2,
            $movie->medium_screenshot_image3
        ];

        $actors = [];
        foreach ($movie->cast as $key => $actor){
            $actors[$key] = [
                'name' => $actor->name,
                'img' => $actor->url_small_image ?? null
            ];
        }

        $torrents = [];
        foreach ($movie->torrents as $key => $torrent){
            $torrents[$key] = [
                'url' => $torrent->url,
                'quality' => $torrent->quality,
                'size' => $torrent->size
            ];
        }

        return ([
            'screenshots' => $screenshots,
            'actors' => $actors,
            'torrents' => $torrents,
            'yt_trailer_code' => $movie->yt_trailer_code,
            'runtime' => $movie->runtime
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
