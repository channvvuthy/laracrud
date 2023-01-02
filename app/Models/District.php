<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $table = "districts";

    protected $fillable = [
        'province_id',
        'name',
        'description'
    ];

    public function commune(){
        return $this->hasMany(App\Models\Commune::class,"district_id","id");
    }

    public function province(){
        return $this->belongsTo(App\Models\Province::class,"district_id","id");
    }
}
