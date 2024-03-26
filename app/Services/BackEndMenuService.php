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
                'name' => 'Bible Document',
                'action' => 'admin/library',
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
                'name' => 'Social',
                'action' => 'admin/social',
                'icon' => 'fa fa-globe',
            ],
            [
                'name' => 'Bank',
                'action' => 'admin/bank',
                'icon' => 'fa fa-building',
            ],
            [
                'name' => 'Font',
                'action' => 'admin/font',
                'icon' => 'fa fa-font',
            ],
            [
                'name' => 'Paypal' ,
                'action' => 'admin/paypal',
                'icon' => 'fa fa-money-bill-wave',
            ],
            [
                'name' => 'Setting',
                'action' => 'admin/setting',
                'icon' => 'fa fa-cogs',
            ],
        ];
    }
}
