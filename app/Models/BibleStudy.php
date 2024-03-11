<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BibleStudy extends Model
{
    use HasFactory;

    protected $table = 'bible_studies';

    protected $fillable = [
        'photo',
        'title_en',
        'title_kh',
        'caption_en',
        'caption_kh',
        'type',
    ];
}
