<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $table = 'products';
    protected $fillable = [
        'code',
        'name',
        'photo',
        'description',
        'category_id',
        'brand_id',
        'unit_id',
        'purchase_price',
        'sale_price',
        'quantity',
        'status'
    ];

}
