<?php

namespace Database\Seeders;

use App\Models\BibleType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BibleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bibleType = [
            ['type' => 'video'],
            ['type' => 'doc'],
        ];
        DB::table('bible_types')->truncate();
        BibleType::create($bibleType);
    }
}
