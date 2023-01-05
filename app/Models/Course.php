<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = "courses";
    /**
     * @var string
     */
    public string $moduleName = "Course";
    /**
     * @var string[]
     */
    protected $fillable = [
        'icon', 'name', 'description'
    ];
}
