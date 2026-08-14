<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MdmsContent extends Model
{
    protected $fillable = [
        'state_slug',
        'banner_title',
        'banner_description',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'title',
        'subtitle',
        'intro',
        'sections',
    ];

    protected function casts(): array
    {
        return [
            'sections' => 'array',
        ];
    }
}
