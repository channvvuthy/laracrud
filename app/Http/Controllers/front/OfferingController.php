<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Offering;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Date;

class OfferingController extends Controller
{
    public function index()
    {
        $title = 'Offering';
        $offering = Offering::first();
        $banks = $this->getBanks();

        return view('front-end.offering', compact('title', 'offering', 'banks'));
    }

    /**
     * Retrieve the list of banks from the cache or database.
     */
    public function getBanks(){
        return Cache::remember('banks' , Date::now()->addMonth(), function () {
        return Bank::get();
        }); 
    }
}
