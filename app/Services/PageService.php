<?php
namespace App\Services;

use Illuminate\Support\Facades\Cache;
use App\Models\Page;

class PageService
{
    /**
     * Get pages from cache or load if not available.
     *
     * @return \Illuminate\Database\Eloquent\Collection|mixed
     */
    public static function getPages()
    {
        if(Cache::has('pages')){
            return Cache::get('pages');
        }

        return self::loadPages();
    }

    /**
     * Set pages into cache.
     *
     * @param  \Illuminate\Database\Eloquent\Collection  $pages
     * @return void
     */
    public static function setPages($pages)
    {
        Cache::put('pages', $pages, 60);
    }

    /**
     * Load pages from the database and set into cache.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function loadPages()
    {
        $pages = Page::orderBy('id', 'asc')
        ->with('children')
        ->where('parent_id', null)
        ->get();
        self::setPages($pages);
        return $pages;
    }
}
