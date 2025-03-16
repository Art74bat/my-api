<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HardWarePrice extends Model
{
    protected $fillable = [
        'category',
        'title',
        'subtitle',
        'route',
        'description',
        'price',
    ];
}
