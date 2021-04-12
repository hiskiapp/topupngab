<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Item;
use App\Models\Schedule;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class DataController extends Controller
{
    public function customers()
    {
        $customers = User::select('name', 'number', 'is_business', 'created_at', 'id')->get();

        return DataTables::of($customers)
        ->editColumn('created_at', function ($customer) {
            return $customer->created_at ? with(new Carbon($customer->created_at))->format('d F Y H:i') : '';
        })
        ->addIndexColumn()
        ->make();
    }

    public function games()
    {
        $games = Game::withCount('items')->select('code', 'name', 'item', 'updated_at', 'id')->get();

        return DataTables::of($games)
        ->addIndexColumn()
        ->make();
    }

    public function items($game)
    {
        $items = Item::whereGameId($game)
        ->orderBy('amount', 'asc')
        ->get();

        return DataTables::of($items)
        ->editColumn('updated_at', function ($item) {
            return $item->updated_at ? with(new Carbon($item->updated_at))->format('d F Y H:i') : '';
        })
        ->addIndexColumn()
        ->make();
    }

    public function schedules()
    {
        $schedules = Schedule::select('message', 'media', 'sent_at', 'status', 'id')->get();

        return DataTables::of($schedules)
        ->editColumn('sent_at', function ($schedule) {
            return $schedule->sent_at ? with(new Carbon($schedule->sent_at))->format('d F Y H:i') : '';
        })
        ->addIndexColumn()
        ->make();
    }

    public function settings()
    {
        $settings = Setting::select('slug', 'name', 'value', 'updated_at', 'id')->get();

        return DataTables::of($settings)
        ->editColumn('sent_at', function ($setting) {
            return $setting->updated_at ? with(new Carbon($setting->updated_at))->format('d F Y H:i') : '';
        })
        ->addIndexColumn()
        ->make();
    }

    public function transactions()
    {

    }

    public function users()
    {
        $users = User::select('name', 'email', 'number', 'id')->get();

        return DataTables::of($users)
        ->addIndexColumn()
        ->make();
    }
}
