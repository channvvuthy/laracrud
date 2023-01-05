<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("settings")->insert([
            'name' => 'J Learning',
            'logo' => 'J Learning',
            'email' => 'J Learning',
            'address' => 'J Learning',
            'about' => 'J Learning',
            'facebook' => 'J Learning',
            'tiktok' => 'J Learning',
            'youtube' => 'J Learning',
            'instagram' => 'J Learning',
            'phone' => 'J Learning',
            'map' => 'J Learning',
        ]);
    }
}
