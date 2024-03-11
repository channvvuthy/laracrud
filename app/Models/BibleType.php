<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BibleType extends Model
{
    use HasFactory;

    protected $table = 'bible_types';
    protected $fillable = [
        'name',
    ];
}
