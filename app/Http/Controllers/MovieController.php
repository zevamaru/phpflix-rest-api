<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Director;
use App\Models\Actor;
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
        return response()->json($movies);
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
        $director = Director::find($request->director_id);
        $movie->save();
        $data = [
            'message' => 'Movie added: '.$movie->name.' directed by '.$director->name,
            'movie' => $movie
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
        $data = [
            'movie' => $movie,
            'actors' => $movie->actors
        ];
        return response()->json($data);
    }

    /**
     * Attach to a specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function attach(Request $request)
    {
        $movie = Movie::find($request->movie_id);
        $actor = Actor::find($request->actor_id);
        $movie->actors()->attach($request->actor_id);
        return response()->json([
            'message' => 'Actor '.$actor->name.' added to movie '.$movie->name.'.'
        ]);
    }
}
