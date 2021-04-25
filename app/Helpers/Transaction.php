<?php

use App\Models\Transaction;

if (!function_exists('topup_waiting')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function topup_waiting()
    {
        return number_format(Transaction::whereStatus(1)->count());
    }
}
