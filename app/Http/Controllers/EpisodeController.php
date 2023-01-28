<?php

namespace App\Http\Controllers;

use App\Models\Director;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Tvshow;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $episodes = Episode::all();

        $data = [];
        foreach ($episodes as $episode) {
            $season = Season::find($episode->season_id);
            $tvshow = Tvshow::find($season->tvshow_id);
            array_push($data, [
                'id' => $episode->id,
                'number' => $episode->number,
                'name' => $episode->name,
                'tvshow' => $tvshow->name,
                'season' => $season->number,
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
        $episode = new Episode;
        $episode->name = $request->name;
        $episode->number = $request->number;
        $episode->season_id = $request->season_id;
        $episode->save();
        $season = Season::find($request->season_id);
        $tvshow = Tvshow::find($season->tvshow_id);
        $season->episodes()->attach($episode->id);
        $data = [
            'message' => 'Episode '.$episode->number.'. '.$episode->name.' added to '.$tvshow->name.' (Season '.$season->number.')',
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function show(Episode $episode)
    {
        $season = Season::find($episode->season_id);
        $tvshow = Tvshow::find($season->tvshow_id);
        $director = Director::find($tvshow->director_id);

        $data = [
            'number' => $episode->number,
            'name' => $episode->name,
            'season' => $season->number,
            'tvshow' => $tvshow->name,
            'director' => $director->name,
        ];

        return response()->json($data);
    }
}
