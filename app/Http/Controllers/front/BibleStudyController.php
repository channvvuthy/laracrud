<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\BibleStudyLibrary;
use App\Services\BibleStudyService;
use Illuminate\Http\Request;

class BibleStudyController extends Controller
{
    public function index()
    {
        $type = request()->get('type');
        $detail = request()->get('detail');

        if ($detail) {
            return $this->detail($type, $detail);
        }

        $title = 'Bible Study';
        $bibleStudies = BibleStudyService::getBibleStudies($type, 4);
        return view('front-end.' . $type, compact('title', 'bibleStudies'));
    }

    /**
     * A description of the entire PHP function.
     *
     * @param  $type description
     * @param  $id description
     */
    public function detail($type, $id)
    {
        $bibleStudy = BibleStudyService::getBibleDetail($id);
        $libraries = BibleStudyService::getLibraries($id);

        return view('front-end.' . $type . '-detail', compact('libraries', 'bibleStudy'));
    }
}
