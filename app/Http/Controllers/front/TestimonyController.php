<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Services\TestimonyService;

class TestimonyController extends Controller
{
    public function index()
    {
        $title = 'Testimonies';
        $testimonies = TestimonyService::getTestimonies(4);
        return view('front-end.testimony', compact('title', 'testimonies'));
    }
}
