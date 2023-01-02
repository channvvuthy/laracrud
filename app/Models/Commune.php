<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    use HasFactory;

    protected $table = "communes";

    protected $fillable = [
        'commune_id',
        'name',
        'description'
    ];

    public function village()
    {
        return $this->hasMany(App\Models\Village::class, "commune_id", "id");
    }

    public function district()
    {
        return $this->belongsTo(App\Models\District::class, "commune_id", "id");
    }
}
