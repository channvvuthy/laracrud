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

    /**
     * Retrieve the libraries associated with the bible study.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function libraries(){
        return $this->hasMany(Library::class, 'bible_study_id', 'id');
    }
}
