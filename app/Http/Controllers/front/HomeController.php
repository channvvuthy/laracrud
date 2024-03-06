<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Services\HomeService;

class HomeController extends Controller
{
    public function index()
    {

        $welcome = HomeService::getWelcome();
        $title = 'Home';

        return view('front-end.home', compact('welcome', 'title'));
    }
}
