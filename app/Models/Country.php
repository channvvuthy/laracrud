<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $table = "countries";

    /**
     * @var string
     */
    public string $moduleName = "country";

    protected $fillable = [
        'name',
        'description'
    ];
    /**
     * @var array|string[]
     */
    public array $detail = ['id', 'name', 'description', 'created_at', 'updated_at'];
    public function province()
    {
        return $this->hasMany(Province::class, "country_id", "id");
    }

    public function district()
    {
        return $this->hasManyThrough(District::class, Province::class);
    }
}
