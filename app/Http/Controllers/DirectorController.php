<?php

namespace App\Http\Controllers;

use App\Models\Director;
use Illuminate\Http\Request;

class DirectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $directors = Director::all('id', 'name');

        return response()->json($directors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $director = new Director;
        $director->name = $request->name;
        $director->save();
        $data = [
            'message' => 'Director added.',
            'director' => $director,
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Director  $actor
     * @return \Illuminate\Http\Response
     */
    public function show(Director $director)
    {
        return response()->json($director);
    }
}
