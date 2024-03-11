<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use App\Models\Menu;

class CRUDBaseController extends Controller
{
    public string $method = "index";

    public function __construct()
    {
        $this->method = $this->getMethodFromUrl();
        $this->initMenu();
        $this->initStaticMenus();
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
        return Menu::with('childrend')
            ->where('parent_id', NULL)
            ->orderBy('order')->get();
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

    /**
     * Initialize static menus.
     */
    private function initStaticMenus()
    {
        $staticMenus = [
            [
                'name' => 'Home',
                'action' => 'admin/home',
                'icon' => 'fa fa-home',
            ],
            [
                'name' => 'Who We Are',
                'action' => 'admin/whoweare',
                'icon' => 'fa fa-question',
            ],
            [
                'name' => 'Vision & Mission',
                'action' => 'admin/visionandmission',
                'icon' => 'fa fa-eye',
            ],
            [
                'name' => 'Church Service',
                'action' => 'admin/churchservice',
                'icon' => 'fa fa-church',
            ],
            [
                'name' => 'Bible Study',
                'action' => 'admin/biblestudy',
                'icon' => 'fa fa-bible',
            ],
            [
                'name' => 'Testimony',
                'action' => 'admin/testimony',
                'icon' => 'fa fa-comment-dots',
            ]
        ];

        Cache::put('staticMenus', $staticMenus, now()->addYear(1)->diffInMinutes());
    }


}
