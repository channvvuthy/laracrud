<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offering extends Model
{
    use HasFactory;

    protected $table = 'offerings';

    protected $fillable = [
        'title_en',
        'title_kh',
        'description_en',
        'description_kh',
        'way_to_give_en',
        'way_to_give_kh',
        'in_cash_title_en',
        'in_cash_description_en',
        'in_cash_title_kh',
        'in_cash_description_kh',
        'international_title_en',
        'international_title_kh',
        'international_description_kh',
        'international_description_en',
        'via_account_title_en',
        'via_account_title_kh',
    ];
}