<?php

namespace App\Services;

class BackEndMenuService
{
    public static function menus()
    {
        return [
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
            ],
            [
                'name' => 'Contact Us',
                'action' => 'admin/contactus',
                'icon' => 'fa fa-info',
            ],
            [
                'name' => 'Offering',
                'action' => 'admin/offering',
                'icon' => 'fa fa-donate',
            ],
            [
                'name' => 'Bank',
                'action' => 'admin/bank',
                'icon' => 'fa fa-building',
            ]
        ];
    }
}
