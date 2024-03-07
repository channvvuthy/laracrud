<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\VisionMission;
use Illuminate\Http\Request;

class VisionAndMissionController extends Controller
{
    public function index()
    {
        $title = 'Who We Are';
        $visionMissions = VisionMission::orderBy('id', 'desc')->get();

        return view('front-end.vision-and-mission', compact('title', 'visionMissions'));
    }
}
