<?php
namespace App\Services;
use App\Models\Testimony;


class TestimonyService
{
    public static function getTestimonies($limit = 4)
    {
        return Testimony::limit($limit)->get();
    }
}