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
        $file = $request->hasFile('file') ? FileService::upload($request->file) : null;

        $data = [
            'message' => $request->message,
            'file' => $file,
            'file_name' => $request->file_name,
        ];

        Broadcast::create($data);

        dispatch(new WhatsappBroadcast($data));

        return redirect()->route('broadcast.index')->with([
            'type' => 'success',
            'message' => 'Broadcast Sedang Diproses!'
        ]);
    }
}
