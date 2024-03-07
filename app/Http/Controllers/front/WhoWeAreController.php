<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\WhoWeAre;

class WhoWeAreController extends Controller
{
    public function index(){
        $title = 'Who We Are';
        $whoWeAre = WhoWeAre::first();
        
        return view('front-end.who-we-are', compact('title', 'whoWeAre')); 
    }
}
