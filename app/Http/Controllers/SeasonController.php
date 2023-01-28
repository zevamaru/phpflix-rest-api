<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Models\Tvshow;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seasons = Season::all();

        $data = [];
        foreach ($seasons as $season) {
            array_push($data, [
                'season' => $season->number,
                'episodes' => $season->episodes,
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
        $quantity = $request->quantity;
        $tvshow = Tvshow::find($request->tvshow_id);
        for ($i = 1; $i <= $quantity; $i++) {
            $season = new Season;
            $season->number = $i;
            $season->tvshow_id = $request->tvshow_id;
            $season->save();
            $tvshow->seasons()->attach($season->id);
        }
        $data = [
            'message' => $quantity.' seasons added to '.$tvshow->name.'.',
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function show(Season $season)
    {
        $tvshow = Tvshow::find($season->tvshow_id);

        $data = [
            'season' => $season->number,
            'tvshow' => $tvshow->name,
            'episodes' => $season->episodes,
        ];

        return response()->json($data);
    }
}
