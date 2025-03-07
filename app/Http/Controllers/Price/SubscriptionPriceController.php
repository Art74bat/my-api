<?php

namespace App\Http\Controllers\Price;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubscriptionPriceRequest;
use App\Models\SubscriptionPrice;
use Illuminate\Http\Request;

class SubscriptionPriceController extends Controller
{
    public function index ()
    {
        $data = SubscriptionPrice::query()->get();
        return response()->json($data);
    }

    public function store (SubscriptionPriceRequest $request)
    {

        $data = SubscriptionPrice::create([
            'title'=>$request->str('title'),
            'description'=>$request->str('description'),
            'price'=>$request->input('price'),
        ]);
        return response()->json($data);
    }
    public function update (SubscriptionPriceRequest $request, SubscriptionPrice $item)
    {

        if ($request->method() === 'PUT') {
            $item -> update([
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

            $item->update($data);
        }

        
        return response()->json([
            'id'=>$item->id,
        ]);

    }

    public function destroy (SubscriptionPrice $item)
    {
        $item->delete();
        return ['message'=>'The item was deleted'];
    }
}
