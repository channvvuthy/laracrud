<?php
namespace App\Interfaces;
use Illuminate\Http\Request;

interface ApiInterface{
    /**
     * @param Request $request
     * @return mixed
     */
    public function postAdd(Request $request);

}
