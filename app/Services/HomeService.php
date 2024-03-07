<?php

namespace App\Services;

use App\Models\Welcome;

class HomeService
{
    /**
     * Retrieve the welcome message.
     *
     * @return \App\Models\Welcome|null The welcome message if found, otherwise null.
     */
    public static function getWelcome()
    {
        return Welcome::first();
    }
}
