<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('bot.index');
    }

    public function token()
    {
        Setting::whereSlug('token')->update(['value' => Str::random(64)]);

        return back()->with([
            'status' => 'success',
            'message' => 'Token berhasil diperbarui!'
        ]);
    }
}
