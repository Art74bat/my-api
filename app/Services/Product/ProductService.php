<?php


namespace App\Services\Product;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\StoreReviewRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductReview;
use App\Enums\ProductStatus;
use App\Services\DTO\CreateProductDTO;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Collection;

class ProductService 
{
    private Product $product;
    
    public function setProduct(Product $product):ProductService
    {
        $this->product = $product;
        return $this;
    }

    public function published( array $fields = ['id','name','price'] ): Collection
    {
        return Product::query()
        ->select(['id','name','price'])
        ->whereStatus(ProductStatus::Published)
        ->get();
    }

    public function store (CreateProductDTO $data): Product
    {
         /**
         * @var Product $product
         */
        //  add images beside product
        $images = Arr::get($data->toArray(), 'images');

        //  add product beside images
        $product = auth()->user()->products()->create(
            $data->except('images')->toArray(),
        );

        // add images
        if(!empty($image)){
            foreach ($images as $image) {
                $path = $image->storePublicly('images');
                $product->images()->create([
                    'path'=>config('app.url').Storage::path($path),
                ]);
            }
        }
        return $product;
    }
 
    public function update(UpdateProductRequest $request): Product
    {
        if ($request->method() === 'PUT') {
            $this->product->update([
                'name'=>$request->input('name'),
                'description'=>$request->input('description'),
                'count'=>$request->integer('count'),
                'price'=>$request->input('price'),
                'status'=>$request->enum('status',ProductStatus::class),
            ]);
        }else {
            $data = [];

            if ($request->has('name')) {
                $data['name'] = $request->input('name');
            }
            if ($request->has('description')) {
                $data['description'] = $request->input('description');
            }
            if ($request->has('count')) {
                $data['count'] = $request->input('count');
            }
            if ($request->has('price')) {
                $data['price'] = $request->input('price');
            }
            if ($request->has('status')) {
                $data['status'] = $request->input('status');
            }
            
            $this->product->update($data);
        }
        return $this->product;
    }

    public function AddReview(StoreReviewRequest $request): ProductReview
    {
        return $this->product->reviews()->create([
            'user_id'=>auth()->id(),
            'text'=>$request->str('text'),
            'rating'=>$request->integer('rating'),
        ]);
    } 
}