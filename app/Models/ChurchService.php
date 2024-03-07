<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChurchService extends Model
{
    use HasFactory;

    protected $table = 'church_services';
    protected $fillable = ['title_en', 'title_kh','photo', 'timetables'];
}
