<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['default_font', 'navbar_font', 'title_font', 'paragraph_font', 'paragraph_line_height', 'logo'];
}
