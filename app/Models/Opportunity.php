<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'description',
        'image',
        'flag',
        'sort_order',
    ];
}
