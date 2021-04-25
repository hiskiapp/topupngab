<?php

use App\Models\Setting;

if (!function_exists('setting')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function setting(string $slug)
    {
        return Setting::whereSlug($slug)->value('value');
    }
}
