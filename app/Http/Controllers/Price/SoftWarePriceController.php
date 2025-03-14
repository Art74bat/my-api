<?php

namespace App\Http\Controllers\Price;

use App\Http\Controllers\Controller;
use App\Http\Requests\PriceRequest;
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

    public function store (PriceRequest $request)
    {


        $data = SoftWarePrice::create([
            'title'=>$request->str('title'),
            'description'=>$request->str('description'),
            'price'=>$request->input('price'),
        ]);
        return response()->json($data->id);
    }
    public function update (PriceRequest $request, SoftWarePrice $soft)
    {

        if ($request->method() === 'PUT') {
            $soft -> update([
                'title'=>$request->str('title'),
                'description'=>$request->str('description'),
                'price'=>$request->input('price'),
            ]);
        }else{
            $data = [];
            if ($request->has('title')) {
                $data['title'] = $request->input('title');
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
