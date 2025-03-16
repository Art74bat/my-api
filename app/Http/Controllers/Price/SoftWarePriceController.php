<?php

namespace App\Http\Controllers\Price;

use App\Http\Controllers\Controller;
use App\Http\Requests\SoftWarePriceRequest;
use App\Http\Resources\Price\SoftPriceResource;
use App\Models\SoftWarePrice;
use Illuminate\Http\Request;

class SoftWarePriceController extends Controller
{
    public function index ()
    {
        $data = SoftWarePrice::query()->get();
        return SoftPriceResource::collection($data);
    }

    public function store (SoftWarePriceRequest $request)
    {
        // dd($request);

        $data = SoftWarePrice::create([
            'category'=>$request->str('category'),
            'route'=>$request->str('route'),
            'description'=>$request->str('description'),
            'price'=>$request->input('price'),
        ]);
        return response()->json($data->id);
    }
    public function update (SoftWarePriceRequest $request, SoftWarePrice $soft)
    {
        // dd($request);
        if ($request->method() === 'PUT') {
            $soft -> update([
                'category'=>$request->str('category'),
                'route'=>$request->str('route'),
                'description'=>$request->str('description'),
                'price'=>$request->input('price'),
            ]);
        }else{
            $data = [];
            if ($request->has('category')) {
                $data['category'] = $request->input('category');
            }
            if ($request->has('route')) {
                $data['route'] = $request->input('route');
            }
            if ($request->has('description')) {
                $data['description'] = $request->input('description');
            }
            if ($request->has('price')) {
                $data['price'] = $request->input('price');
            }

            $soft->update($data);
        }


        return response()->json([
            'id'=>$soft->id,
        ]);

    }

    public function destroy (SoftWarePrice $soft)
    {
        $soft->delete();
        return ['message'=>'The item was deleted'];
    }
}
