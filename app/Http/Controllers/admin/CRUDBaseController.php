<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;

class CRUDBaseController extends Controller
{
    public string $method = "index";

    public function __construct()
    {
        $this->method = is_numeric(basename(URL::current())) ? "edit" : basename(URL::current());
        $this->initMenu();
    }

    public function initMenu()
    {
        if (env("APP_ENV") == "local") {
            $menus = DB::table("menus")->select('icon', 'name', 'action')->orderBy('order', 'asc')->get();
            Cache::put('menus', $menus, 60 * 24);
        } else {
            if (!Cache::has('menus')) {
                $menus = DB::table("menus")->select('icon', 'name', 'action')->orderBy('order', 'asc')->get();
                if (count($menus)) {
                    Cache::put('menus', $menus, 60 * 24);
                }
            }
        }

    }
}
