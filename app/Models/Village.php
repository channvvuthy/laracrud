<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;
    protected $table = "villages";
    protected $fillable = [
        'commune_id',
        'name',
        'description'
    ];

    public function commune()
    {
        return $this->belongsTo(App\Models\Commune::class, "commune_id", "id");
    }
}
