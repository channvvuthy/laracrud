<?php

use Illuminate\Support\Facades\URL;

class Helper
{
    /**
     * @return array|string|null
     */
    public static function indexUrl(): array|string|null
    {
        $pattern = '/add/i';
        $indexUrl = preg_replace("/\bedit\b.*$/", '', preg_replace($pattern, '', URL::current()));
        $indexUrl = preg_replace("/\bdelete\b.*$/", "", $indexUrl);
        $indexUrl = preg_replace("/\badd\b.*$/", "", $indexUrl);
        return preg_replace("/\bdetail\b.*$/", '', $indexUrl);
    }

    /**
     * @param $uploadPath
     * @param $file
     * @return array|string|void
     */
    public static function imageUpload($uploadPath, $file)
    {
        if (env("FILESYSTEM_DISK") == "local") {
            if (is_array($file)) {
                $fileNames = [];
                foreach ($file as $f) {
                    $fileName = time() . '.' . $f->getClientOriginalName();
                    $f->move(public_path($uploadPath), $fileName);
                    $fileNames[] = url('/') . "/" . $uploadPath . "/" . $fileName;
                }
                return implode(",", $fileNames);
            } else {
                $fileName = time() . $file->getClientOriginalName();
                $file->move(public_path($uploadPath), $fileName);
                return url('/') . "/" . $uploadPath . "/" . $fileName;
            }
        }
    }
}
