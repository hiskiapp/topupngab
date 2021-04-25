<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use App\Models\Setting;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::all();

        return view('settings.index', compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SettingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(SettingRequest $request)
    {
        //
    }
}
