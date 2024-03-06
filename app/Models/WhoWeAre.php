<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhoWeAre extends Model
{
    use HasFactory;

    protected $table = "who_we_ares";
    protected $fillable = [
        'title_en',
        'title_kh',
        'photo',
        'description_en',
        'description_kh',
    ];
}
