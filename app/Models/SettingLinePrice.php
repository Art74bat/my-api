<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingLinePrice extends Model
{
    protected $fillable = [
        "title",
        "description",
        "price",
    ];
}
