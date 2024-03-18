<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Services\TestimonyService;

class TestimonyController extends Controller
{
    /**
     * Index function to display testimonies.
     */
    public function index()
    {
        $title = 'Testimonies';
        $pageSize = request()->get('page_size') ?? 4;
        $testimonies = TestimonyService::getTestimonies($pageSize);
        return view('front-end.testimony', compact('title', 'testimonies'));
    }

    public function detail($id)
    {
        $testimony = TestimonyService::getTestimonyDetail($id);
        $title = 'Testimonies';
        return view('front-end.testimony-detail', compact('title', 'testimony'));
    }
}
