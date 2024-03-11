<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Services\BibleStudyService;
use Illuminate\Http\Request;

class BibleStudyController extends Controller
{
    public function index()
    {
        $type = request()->get('type');
        $title = 'Bible Study';
        $bibleStudies = BibleStudyService::getBibleStudies($type, 4);
        return view('front-end.'.$type, compact('title', 'bibleStudies'));
    }
}
