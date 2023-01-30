<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Director;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::all();

        $data = [];
        foreach ($movies as $movie) {
            $director = Director::find($movie->director_id);
            array_push($data, [
                'id' => $movie->id,
                'movie' => $movie->name,
                'genre' => $movie->genre,
                'director' => $director->name,
                'actors' => $movie->actors,
            ]);
        }

        return response()->json($data);
    }

    /**
     * Search movies by name.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        // String query
        $query = $request->q;
        $movies = Movie::query()->where('name', 'LIKE', "%{$query}%")->get();

        if (! count($movies)) {
            return response()->json([
                'message' => 'No search results found.',
            ]);
        }

        $data = [];
        foreach ($movies as $movie) {
            $director = Director::find($movie->director_id);
            array_push($data, [
                'id' => $movie->id,
                'movie' => $movie->name,
                'genre' => $movie->genre,
                'director' => $director->name,
                'actors' => $movie->actors,
            ]);
        }

        return response()->json($data);
    }

    /**
     * Filter by name or genre (POST).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        // Define type of filtering
        $filter_by = $request->filter_by;
        // String query
        $search = $request->search;

        if ($filter_by === 'name' || $filter_by === 'genre') {
            $movies = Movie::query()->where($filter_by, 'LIKE', "%{$search}%")->get();
        }

        if (! count($movies)) {
            return response()->json([
                'message' => 'No search results found.',
            ]);
        }

        $data = [];
        foreach ($movies as $movie) {
            $director = Director::find($movie->director_id);
            array_push($data, [
                'id' => $movie->id,
                'movie' => $movie->name,
                'genre' => $movie->genre,
                'director' => $director->name,
                'actors' => $movie->actors,
            ]);
        }

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $movie = new Movie;
        $movie->name = $request->name;
        $movie->genre = $request->genre;
        $movie->director_id = $request->director_id;
        $movie->save();
        $director = Director::find($request->director_id);
        $data = [
            'message' => 'Movie added: '.$movie->name.' directed by '.$director->name,
            'movie' => $movie,
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        $director = Director::find($movie->director_id);

        $data = [
            'movie' => $movie->name,
            'genre' => $movie->genre,
            'director' => $director->name,
            'actors' => $movie->actors,
        ];

        return response()->json($data);
    }

    /**
     * Attach an actor to a movie.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function attach(Request $request)
    {
        $movie = Movie::find($request->movie_id);
        $actor = Actor::find($request->actor_id);
        $movie->actors()->attach($request->actor_id);

        return response()->json([
            'message' => 'Actor '.$actor->name.' added to movie '.$movie->name.'.',
            'actor' => $actor
        ]);
    }
}
