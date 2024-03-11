<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offering extends Model
{
    use HasFactory;

    protected $table = 'offerings';

    protected $fillable = [
        'title_en',
        'title_kh',
        'description_en',
        'description_kh',
        'way_to_give_en',
        'way_to_give_kh',
    ];
}