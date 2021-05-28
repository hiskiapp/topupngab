<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use App\Models\Schedule;
use Facades\Services\FileService;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('schedules.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('schedules.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ScheduleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScheduleRequest $request)
    {
        Schedule::create([
            'message' => $request->message,
            'media' => $request->hasFile('media') ? FileService::upload($request->file('media')) : null,
            'sent_at' => Carbon::parse($request->sent_at)->toDateTimeString(),
        ]);

        return redirect()->route('schedules.index')->with([
            'status' => 'success',
            'message' => 'Schedule Berhasil Ditambahkan!'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);

        return view('schedules.edit', compact('schedule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ScheduleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ScheduleRequest $request, $id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->update([
            'message' => $request->message,
            'media' => FileService::upload($request->file('media'), $schedule->media),
            'sent_at' => Carbon::parse($request->sent_at)->toDateTimeString(),
        ]);

        return back()->with([
            'status' => 'success',
            'message' => 'Schedule berhasil diperbarui!'
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
        Schedule::findOrFail($id)->delete($id);

        return response()->json(true);
    }
}
