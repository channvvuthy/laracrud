<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    public $table = "provinces";
    /**
     * @var string
     */
    public string $moduleName = "Province";

    /**
     * @var array|string[]
     */
    public array $detail = ['id','country_id', 'name', 'description', 'created_at', 'updated_at'];

    protected $fillable = [
        'country_id',
        'name',
        'description'
    ];

    public function district()
    {
        return $this->hasMany(District::class, "province_id", "id");
    }

    public function country()
    {
        return $this->hasOne(Country::class, "id",);
    }
}
