<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    public $table = 'pages';
    protected $fillable = [
        'parent_id',
        'name_en',
        'name_kh',
        'slug'
    ];

    public function children()
    {
        return $this->hasMany(Page::class, 'parent_id');
    }
}
