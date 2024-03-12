<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    use HasFactory;

    protected $table = 'libraries';

    protected $fillable = [
        'bible_study_id',
        'title_en',
        'title_kh',
        'description_en',
        'description_kh',
        'file',
        'thumbnail',
        'url',
    ];
}
