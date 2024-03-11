<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;

    protected $table = 'contact_us';

    protected $fillable = [
        'title_en',
        'title_kh',
        'photo',
        'address_en',
        'address_kh',
        'facebook',
        'twitter',
        'instagram'
    ];
}
