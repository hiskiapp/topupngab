<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create(['slug' => 'title', 'name' => 'Title', 'value' => 'Top Up Ngab']);
        Setting::create(['slug' => 'token', 'name' => 'Token API', 'value' => Str::random(60)]);
    }
}
