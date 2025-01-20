<?php

namespace App\Services\DTO;

use App\Enums\ProductStatus;
use Spatie\LaravelData\Data;

class CreateProductDTO extends Data
{
    public string $name;
    public string|Optional $description;
    public int|float $price;
    public int $count;
    public ProductStatus $status;
    public array|Optional $images;
}