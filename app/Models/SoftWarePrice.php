<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoftWarePrice extends Model
{
    protected $fillable = [
        "category",
        "route",
        "description",
        "price",
    ];
}
