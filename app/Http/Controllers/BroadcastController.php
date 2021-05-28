<?php

namespace App\Http\Controllers;

use App\Http\Requests\BroadcastRequest;
use App\Jobs\WhatsappBroadcast;
use App\Models\Broadcast;
use Facades\Services\FileService;

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
        $media = $request->hasFile('media') ? FileService::upload($request->media) : null;
        $data = [
            'message' => $request->message,
            'media' => $media,
        ];

        Broadcast::create($data);
        WhatsappBroadcast::dispatch($data);

        return redirect()->route('broadcast.index')->with([
            'status' => 'success',
            'message' => 'Broadcast Sedang Diproses!'
        ]);
    }
}
