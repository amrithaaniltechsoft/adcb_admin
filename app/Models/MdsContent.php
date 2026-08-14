<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MdsContent extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'banner_title',
        'banner_description',
        'banner_image',
        'overview_title',
        'overview_content',
        'middle_banner',
        'specialties',
        'countries',
        'recommendation',
        'content',
        'international_scope',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected function casts(): array
    {
        return [
            'middle_banner' => 'array',
            'specialties' => 'array',
            'countries' => 'array',
            'recommendation' => 'array',
        ];
    }
}
