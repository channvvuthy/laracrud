<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Offering;
use Illuminate\Http\Request;

class OfferingController extends Controller
{
    public function index()
    {
        $title = 'Offering';
        $offering = Offering::first();
        return view('front-end.offering', compact('title', 'offering'));
    }
}
