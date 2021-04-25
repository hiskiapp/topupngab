<?php

namespace App\Http\Controllers;

use App\Models\Customer;
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
        $customers = Customer::withCount('transactions')->get();

        return DataTables::of($customers)
        ->editColumn('created_at', function ($customer) {
            return $customer->created_at ? with(new Carbon($customer->created_at))->format('d F Y H:i') : '';
        })
        ->addIndexColumn()
        ->make();
    }

    public function games()
    {
        $games = Game::select('code', 'name', 'unit', 'updated_at', 'id')->get();

        return DataTables::of($games)
        ->editColumn('updated_at', function ($game) {
            return $game->updated_at ? with(new Carbon($game->updated_at))->format('d F Y H:i') : '';
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
        ->editColumn('updated_at', function ($setting) {
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
        $users = User::select('name', 'email', 'number', 'updated_at', 'id')->get();

        return DataTables::of($users)
        ->editColumn('updated_at', function ($user) {
            return $user->updated_at ? with(new Carbon($user->updated_at))->format('d F Y H:i') : '';
        })
        ->addIndexColumn()
        ->make();
    }
}
