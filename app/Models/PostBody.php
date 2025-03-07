<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostBody extends Model
{
    protected $fillable = [
        'post_id',
        'sub_title',
        'body',
    ];

    public function posts ()
    {
        return $this->belongsTo(Post::class);
    }
}
