<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Cache;

class ContactUsController extends Controller
{
    public function index()
    {
        $title = 'About Us';
        $contactUs = ContactUs::first();
        $socials = Cache::rememberForever('socials', function () {
            return \App\Models\Social::all();
        });
        
        return view('front-end.contact-us', compact('title', 'contactUs', 'socials'));
    }
}
