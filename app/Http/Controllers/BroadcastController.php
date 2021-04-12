<?php

namespace App\Http\Controllers;

use App\Http\Requests\BroadcastRequest;

class BroadcastController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('broadcast.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\BroadcastRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BroadcastRequest $request)
    {
        //
    }
}
