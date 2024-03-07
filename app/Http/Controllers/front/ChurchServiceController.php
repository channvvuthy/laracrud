<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\ChurchService;
use Illuminate\Http\Request;

class ChurchServiceController extends Controller
{
    public function index()
    {

        $title = 'Church Service';
        $churchServce = ChurchService::first();
        
        return view('front-end.church-service', compact('title', 'churchServce'));
    }
}
