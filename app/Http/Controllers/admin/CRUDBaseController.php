<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;

class CRUDBaseController extends Controller
{
    public string $method = "index";

    public function __construct()
    {
        $this->method = $this->getMethodFromUrl();
        $this->initMenu();
    }

    /**
     * @return string
     */
    private function getMethodFromUrl(): string
    {
        $currentUrl = URL::current();
        $basename = basename($currentUrl);

        return is_numeric($basename) ? 'edit' : $basename;
    }

    /**
     * @return mixed
     */
    public function initMenu(): mixed
    {
        if (!$this->isMenusCached()) {
            $menus = $this->getMenus();

            if (!empty($menus)) {
                $this->cacheMenus($menus);
            }
        }

        return $this->getCachedMenus();
    }

    /**
     * @return Collection
     */
    public function getMenus(): Collection
    {
        return DB::table('menus')
            ->select('icon', 'name', 'action')
            ->orderBy('order', 'asc')
            ->get();
    }

    /**
     * @return bool
     */
    private function isMenusCached(): bool
    {
        return Cache::has('menus');
    }

    /**
     * @param $menus
     * @return void
     */
    private function cacheMenus($menus): void
    {
        Cache::put('menus', $menus, 60 * 24);
    }

    /**
     * @return mixed
     */
    private function getCachedMenus(): mixed
    {
        return Cache::get('menus');
    }


}
