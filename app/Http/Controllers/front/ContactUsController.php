<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;

class ContactUsController extends Controller
{
    public function index()
    {
        $title = 'About Uw';
        $contactUs = ContactUs::first();
        return view('front-end.contact-us', compact('title', 'contactUs'));
    }
}
