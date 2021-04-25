<?php

namespace App\Http\Controllers;

use App\Http\Requests\GameRequest;
use App\Models\Game;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('games.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('games.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\GameRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GameRequest $request)
    {
        Game::create([
            'code' => $request->code,
            'name' => $request->name,
            'unit' => $request->unit,
            'items' => json_encode($request->items)
        ]);

        return redirect()->route('games.index')->with([
            'status' => 'success',
            'message' => 'Game berhasil disimpan!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $game = Game::findOrFail($id);

        return view('games.show', compact('game'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $game = Game::findOrFail($id);

        return view('games.edit', compact('game'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\GameRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GameRequest $request, $id)
    {
        Game::findOrFail($id)->update([
            'code' => $request->code,
            'name' => $request->name,
            'unit' => $request->unit,
            'items' => json_encode($request->items)
        ]);

        return redirect()->route('games.index')->with([
            'status' => 'success',
            'message' => 'Game berhasil diperbarui!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Game::findOrFail($id)->delete();

        return response()->json(true);
    }
}
