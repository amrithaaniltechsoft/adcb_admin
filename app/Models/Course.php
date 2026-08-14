<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name',
        'code',
        'title',
        'description',
        'image',
        'href',
        'sort_order',
        'featured',
    ];

    protected function casts(): array
    {
        return [
            'featured' => 'boolean',
        ];
    }
}
