<?php
namespace App\Services;

use App\Models\Welcome;

class HomeService
{
    public static function getWelcome()
    {
        return Welcome::first();
    }
}