<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\VisionMission;
use Illuminate\Http\Request;

class VisionAndMissionController extends Controller
{
    public function index()
    {
        $siteTitle = 'Visionandmission';
        $visionMissions = VisionMission::orderBy('id', 'desc')->get();

        return view('front-end.vision-and-mission', compact('siteTitle', 'visionMissions'));
    }
}
