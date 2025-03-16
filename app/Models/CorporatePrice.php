<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CorporatePrice extends Model
{
    protected $fillable = [
        "category",
        "route",
        "description",
        "price",
    ];
}
