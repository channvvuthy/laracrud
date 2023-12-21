<?php

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;

class Helper
{
    /**
     * @return array|string|null
     */
    public static function indexUrl(): ?string
    {
        $patterns = ['/add/i', '/\bedit\b.*$/', '/\bdelete\b.*$/', '/\bdetail\b.*$/'];

        $indexUrl = URL::current();

        foreach ($patterns as $pattern) {
            $indexUrl = preg_replace($pattern, '', $indexUrl);
        }

        return $indexUrl ?: null;
    }


    /**
     * @param $uploadPath
     * @param $file
     * @return array|string|void
     */
    public static function imageUpload($uploadPath, $file)
    {
        if (env("FILESYSTEM_DISK") == "local") {
            return static::uploadToLocal($uploadPath, $file);
        } else {
            // Handle other disk types (e.g., S3)
            return static::uploadToS3($uploadPath, $file);
        }
    }

    /**
     * Uploads a file or multiple files to a local destination.
     *
     * @param string $uploadPath The path where the file(s) will be uploaded.
     * @param mixed $file The file(s) to be uploaded. It can be a single file or an array of files.
     * @return mixed The result of the upload process.
     */
    protected static function uploadToLocal($uploadPath, $file)
    {
        if (is_array($file)) {
            return static::uploadMultipleToLocal($uploadPath, $file);
        }

        return static::uploadSingleToLocal($uploadPath, $file);
    }

    /**
     * Uploads multiple files to a local directory.
     *
     * @param string $uploadPath The path to upload the files to.
     * @param array $files An array of uploaded files.
     * @return string The concatenated file names.
     */
    protected static function uploadMultipleToLocal($uploadPath, array $files)
    {
        $fileNames = [];

        foreach ($files as $file) {
            $fileName = static::generateUniqueFileName($file->getClientOriginalName());
            $file->move(public_path($uploadPath), $fileName);
            $fileNames[] = url('/') . "/" . $uploadPath . "/" . $fileName;
        }

        return implode(",", $fileNames);
    }

    /**
     * Uploads a single file to a local directory and returns the URL of the uploaded file.
     *
     * @param string $uploadPath The path where the file will be uploaded.
     * @param object $file The file object to be uploaded.
     * @return string The URL of the uploaded file.
     */
    protected static function uploadSingleToLocal($uploadPath, $file)
    {
        $fileName = static::generateUniqueFileName($file->getClientOriginalName());
        $file->move(public_path($uploadPath), $fileName);
        return url('/') . "/" . $uploadPath . "/" . $fileName;
    }

    /**
     * Generates a unique file name based on the original name.
     *
     * @param string $originalName The original name of the file.
     * @return string The unique file name.
     */
    protected static function generateUniqueFileName($originalName)
    {
        return time() . '.' . $originalName;
    }

    /**
     * Uploads a file to an S3 bucket.
     *
     * @param string $uploadPath The path where the file should be uploaded.
     * @param mixed $file The file to be uploaded.
     * @throws Exception If the upload fails.
     * @return void
     */
    protected static function uploadToS3($uploadPath, $file)
    {
        // Implement S3 upload logic here
        // Example: Storage::disk('s3')->put($uploadPath, $file);
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
     * Retrieves the module name from the current request.
     *
     * @return string|null The module name if found, or null if not found.
     */
    public static function getModuleName(): ?string
    {
        $segments = request()->segments();
        return ucfirst($segments[1] ?? null);
    }
}
