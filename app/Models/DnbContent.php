<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DnbContent extends Model
{
    protected $fillable = [
        'banner_title',
        'banner_description',
        'intro_title',
        'intro_description',
        'specialties',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];
}
