<?php

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Carbon\Carbon;


class Helper
{
    /**
     * @return array|string|null
     */
    public static function indexUrl(): ?string
    {
        $patterns = ['/add/i', '/\bedit\b.*$/', '/\bdelete\b.*$/', '/\bdetail\b.*$/'];

        $indexUrl = URL::current();

        if(config('app.env') == 'production') {
            $indexUrl = str_replace('localhost:8080', 'ecc-church.com', $indexUrl);
        }

        foreach ($patterns as $pattern) {
            $indexUrl = preg_replace($pattern, '', $indexUrl);
        }

        return $indexUrl ?: null;
    }

    public static function requestUrl(){
        $requestUrl = request()->url();
        
        if(config('app.env') == 'production') {
            $requestUrl = str_replace('localhost:8080', 'ecc-church.com', $requestUrl);
        }
        return $requestUrl;
    }


    public static function imageUpload($uploadPath, $files)
    {
        if (env("FILESYSTEM_DISK") == "local") {
            $fileNames = [];

            // Ensure $files is always treated as an array
            $files = is_array($files) ? $files : [$files];

            foreach ($files as $file) {
                $fileName = time() . '.' . $file->getClientOriginalName();
                $file->move(public_path($uploadPath), $fileName);
                $fileNames[] = url('/') . "/" . $uploadPath . "/" . $fileName;
            }

            return implode(",", $fileNames);
        }

        // If the filesystem disk is not "local", you might want to handle that case
        return null; // or throw an exception, log a warning, etc.
    }


    /**
     * @param $string
     * @param $limit
     * @return mixed|string
     */
    public static function subStr($string, $limit): mixed
    {
        if (strlen($string) > $limit) {
            return \Illuminate\Support\Str::substr($string, 0, $limit) . "...";
        }
        return $string;
    }

    public static function getCurrentRouteName(): ?string
    {
        // Get the name of the current route
        return Route::currentRouteName();
    }

    /**
     * Retrieves the real title from the current route.
     *
     * @return string The real title extracted from the route.
     */
    public static function getDetailTitle(): string
    {
        $title = self::getCurrentRouteName();
        $title = str_replace('admin', '', $title);
        $title = str_replace('.', ' ', $title);
        return ucfirst($title);
    }

    /**
     * Retrieves the edit title for the current route.
     *
     * @return string The edit title for the current route
     */
    public static function getEditTitle(): string
    {
        return 'Edit ' . str_replace(['.getEdit', 'admin'], '', self::getCurrentRouteName());
    }

    /**
     * Retrieves the title for adding a new module.
     *
     * @return string The title for adding a new module.
     */
    public static function getAddTitle(): string
    {
        return 'Add new ' . self::getModuleName();
    }

    public static function getListTitle(): string
    {
        return self::getModuleName() . ' List';
    }

    /**
     * Retrieves the module name from the current request.
     *
     * @return string|null The module name if found, or null if not found.
     */
    public static function getModuleName(): ?string
    {
        $segments = request()->segments();
        return ucfirst($segments[1] ?? null);
    }

    /**
     * Check if the given menu name is the parent menu.
     *
     * @param mixed $menuName The menu name to check.
     * @return bool Returns true if the menu name is the parent menu, false otherwise.
     */
    public static function isParentMenu($menuName): bool
    {
        return $menuName == request()->input('parent_menu') ?? false;
    }

    /**
     * Cleans the query string from the given URL and returns the path.
     *
     * @param string $url The URL to clean the query string from.
     * @return string The path from the URL.
     */
    public static function cleanQueryString($url): string
    {
        $parsedUrl = parse_url($url);
        return isset($parsedUrl['path']) ? $parsedUrl['path'] : '';
    }

    /**
     * Retrieves the main path from the current request URL by removing any occurrences of '/add' or '/edit'.
     *
     * @return string The main path of the request URL.
     */
    public static function getMainPath(): string
    {
        $currentPath = request()->path();

        // Remove '/add' and '/edit'
        $patterns = ['/add', '/edit'];
        $string = str_replace($patterns, '', $currentPath);

        // Remove dynamic segments (numeric segments in this example)
        $string = preg_replace('/\/\d+/', '', $string);

        // Trim trailing slashes
        $string = rtrim($string, '/');

        return $string;
    }

    /**
     * Modifies the provided object to standardize the name attribute.
     *
     * This function checks if the given object has a 'name_en' or 'name_kh' attribute 
     * and standardizes it to a 'name' attribute. If 'name_en' or 'name_kh' is found,
     * it sets the value to 'name' and removes the original attribute from the object.
     *
     * @param object $attributes The object containing potential 'name', 'name_en', or 'name_kh' attributes.
     * @return object The modified object with a standardized 'name' attribute.
     */
    public static function modifySelectAttribute($attributes)
    {
        $nameKey = 'name';
        if (isset($attributes->name_en)) {
            $nameKey = 'name_en';
        } elseif (isset($attributes->name_kh)) {
            $nameKey = 'name_kh';
        }

        if ($nameKey !== 'name') {
            $attributes->name = $attributes->{$nameKey};
            unset($attributes->{$nameKey});
        }

        return $attributes;
    }

    /**
     * Retrieve content by language.
     *
     * @param string $fileName The name of the file.
     * @return string The content file name with appended locale.
     */
    public static function getContentByLang($fileName)
    {
        $locale = app()->getLocale();
        return  $fileName . "_" . $locale;
    }

    /**
     * A function to retrieve a related name by ID from the given table.
     *
     * @param string $tableName The name of the table to retrieve the related name from
     * @param int $id The ID used to retrieve the related name
     * @return mixed The related name if found, or the ID if not found
     */
    public static function getRelatedNameById($tableName, $id)
    {
        $cacheKey = $tableName . $id;

        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $relational = DB::table($tableName)->where('id', $id)->value('name');

        if ($relational) {
            Cache::put($cacheKey, $relational, 60);
            return $relational;
        }

        return $id;
    }

    /**
     * Limit a string to a specified length.
     *
     * @param string $string The input string to be limited.
     * @param int $limit The maximum length of the string (default is 50).
     * @return string The limited string.
     */
    public static function  limitString($string, $limit = 50)
    {
        if (Str::length($string) > $limit) {
            return Str::limit($string, $limit, '...');
        }
        return $string;
    }

    /**
     * Formats the given time string into a readable format.
     *
     * @param string $time The time string to be formatted.
     * @return string The formatted time string.
     */
    public static function showTime($time)
    {

        $carbonTime = Carbon::createFromFormat('H:i', $time);
        return $carbonTime->format('g:i A');
    }
}
