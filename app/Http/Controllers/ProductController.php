<?php

namespace App\Http\Controllers;

use App\Enums\ProductStatus;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\StoreReviewRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\Product\MinifiedProductResource;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductReviewResource;
use App\Models\Product;
// use App\Models\ProductImage;
use App\Models\ProductReview;
// use App\Models\User;
use App\Services\DTO\CreateProductDTO;
use App\Services\Product\ProductService;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Storage;
use App\Facades\Product as ProductFacade;


class ProductController extends Controller
{

    public function index()
    {
        return MinifiedProductResource::collection(ProductFacade::published());
    }

    public function show(Product $product): ProductResource
    {
        return new ProductResource($product);
    }

    public function store (StoreProductRequest $request,): ProductResource
    { 
        return new ProductResource(ProductFacade::store($request->data()));
    }

    public function review(StoreReviewRequest $request, Product $product): ProductReviewResource
    {  
        return new productReviewResource(
            ProductFacade::setProduct($product)->addReview($request)
        );
    }

    public function update(UpdateProductRequest $request, Product $product): ProductResource
    {
        ProductFacade::setProduct($product)->update($request);
        
        return new ProductResource($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return responseOk();
    }
}
