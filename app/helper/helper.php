<?php

use Illuminate\Support\Facades\URL;

trait Helper
{
    public static function indexUrl()
    {
        $pattern = '/add/i';
        $indexUrl = preg_replace("/\bedit\b.*$/", '', preg_replace($pattern, '', URL::current()));
        $indexUrl = preg_replace("/\bdelete\b.*$/", "", $indexUrl);
        return preg_replace("/\bdetail\b.*$/", '', $indexUrl);
    }
}
