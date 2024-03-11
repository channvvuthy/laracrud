<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BibleStudyLibrary extends Model
{
    use HasFactory;

    protected $table = 'bible_studie_libraries';   

    protected $fillable = [
        'bible_study_id',
        'title_en',
        'title_kh',
        'url',
        'thumbnail',
    ];
}
