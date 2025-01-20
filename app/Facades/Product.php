<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static App\Services\Product\ProductService setProduct(App\Models\Product $product)
 * @method static App\Model\Product  store(App\Services\DTO\CreateProductDTO $data)
*/

/**
 * @see \App\Services\Product\ProductService
 */

class Product extends Facade
{
  protected static function getFacadeAccessor()
  {
    return 'product'; // Replace 'product' with your actual service name in Laravel's Service Container 
  }
}
