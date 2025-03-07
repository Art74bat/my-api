<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HardWarePrice extends Model
{
    protected $fillable = [
        'title',
        'apple',
        'description',
        'price',
    ];
}
