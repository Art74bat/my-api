<?php

namespace App\Models;

use App\Enums\ProductStatus;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'count',
        'price',
        'status',
    ];
    protected $casts = [
        'status' => ProductStatus::class,
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }
    public function reviews ()
    {
        return $this->hasMany(ProductReview::class);
    }
    public function images ()
    {
        return $this->hasMany(ProductImage::class)->select('path');
    }
    public function rating ()
    {
        return round($this->reviews->avg('rating'),1);
    }
    public function isDraft ()
    {
        return $this->status === ProductStatus::Draft;
    }
     public function imageListPath (){
        return $this->images->map(fn(ProductImage $image)=>$image->path);
     }
    

}
