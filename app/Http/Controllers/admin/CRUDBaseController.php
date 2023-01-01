<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;

class CRUDBaseController extends Controller
{
    public string $method = "index";

    public function __construct()
    {
        $this->method = is_numeric(basename(URL::current())) ? "edit" : basename(URL::current());
    }
}
