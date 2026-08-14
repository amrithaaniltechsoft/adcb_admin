<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MbbsContent extends Model
{
    protected $fillable = [
        'state',
        'slug',
        'banner_title',
        'banner_description',
        'banner_image',
        'preview_title',
        'preview_points',
        'content',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];
}
