<?php

namespace App\Http\Controllers;

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
        $status = setting('whatsapp_session');
        $token = setting('token');

        return view('bot.index', compact('status', 'token'));
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
