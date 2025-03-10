<?php

namespace App\Http\Controllers\Price;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecoverPriceRequest;
use App\Http\Resources\Price\PriceResource;
use App\Models\RecoveryPrice;
use Illuminate\Http\Request;

class RecoveryPriceController extends Controller
{
    public function index ()
    {
        $data = RecoveryPrice::query()->get();
        return PriceResource::collection($data);
    }

    public function store (RecoverPriceRequest $request)
    {
        $data = RecoveryPrice::create([
            'title'=>$request->str('title'),
            'description'=>$request->str('description'),
            'price'=>$request->input('price'),
        ]);
        return new PriceResource($data);
    }
    public function update (RecoverPriceRequest $request, RecoveryPrice $recovery)
    {

        if ($request->method() === 'PUT') {
            $recovery -> update([
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

            $recovery->update($data);
        }


        return response()->json([
            'id'=>$recovery->id,
        ]);

    }

    public function destroy (RecoveryPrice $recovery)
    {
        $recovery->delete();
        return ['message'=>'The item was deleted'];
    }
}
