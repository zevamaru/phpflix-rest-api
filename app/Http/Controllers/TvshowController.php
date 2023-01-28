<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Season;
use App\Models\Tvshow;
use Illuminate\Http\Request;

class TvshowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tvshows = Tvshow::all();

        $data = [];
        foreach ($tvshows as $tvshow) {
            array_push($data, [
                'id' => $tvshow->id,
                'tvshow' => $tvshow->name,
                'genre' => $tvshow->genre,
                'seasons' => count($tvshow->seasons),
            ]);
        }

        return response()->json($data);
    }

    /**
     * Search by name or genre (POST).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        // Define type of filtering
        $filter_by = $request->filter_by;
        // String query
        $search = $request->search;

        if ($filter_by === 'name' || $filter_by === 'genre') {
            $tvshows = Tvshow::query()->where($filter_by, 'LIKE', "%{$search}%")->get();
        }

        if (! count($tvshows)) {
            return response()->json([
                'message' => 'No search results found.',
            ]);
        }

        $data = [];
        foreach ($tvshows as $tvshow) {
            array_push($data, [
                'id' => $tvshow->id,
                'tvshow' => $tvshow->name,
                'genre' => $tvshow->genre,
                'seasons' => count($tvshow->seasons),
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
        $tvshow = new Tvshow;
        $tvshow->name = $request->name;
        $tvshow->genre = $request->genre;
        $tvshow->director_id = $request->director_id;
        $tvshow->save();
        $data = [
            'message' => 'TV Show '.$tvshow->name.' added.',
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tvshow  $tvshow
     * @return \Illuminate\Http\Response
     */
    public function show(Tvshow $tvshow)
    {
        // Get all seasons of this TV Show
        $seasons_from_tvshow = Season::where('tvshow_id', $tvshow->id)->get();

        // Array to show seasons with their episodes
        $seasons = [];
        foreach ($seasons_from_tvshow as $season) {
            array_push($seasons, [
                'season' => $season->number,
                'episodes' => $season->episodes,
            ]);
        }

        // Data
        $data = [
            'name' => $tvshow->name,
            'genre' => $tvshow->genre,
            'seasons' => $seasons,
            'actors' => $tvshow->actors,
        ];

        return response()->json($data);
    }

    /**
     * Attach an actor to a TV show.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function attach(Request $request)
    {
        $tvshow = Tvshow::find($request->tvshow_id);
        $actor = Actor::find($request->actor_id);
        $tvshow->actors()->attach($request->actor_id);

        return response()->json([
            'message' => 'Actor '.$actor->name.' added to the TV show '.$tvshow->name.'.',
        ]);
    }
}
