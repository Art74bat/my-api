<?php

namespace App\Http\Controllers\Price;

use App\Http\Controllers\Controller;

use App\Http\Requests\HardWarePriceRequest;
use App\Http\Resources\Price\HardPriceResource;
use App\Models\HardWarePrice;
use Illuminate\Http\Request;

class HardWarePriceController extends Controller
{
    public function index ()
    {
        $data = HardWarePrice::query()->get();
        return HardPriceResource::collection($data);
    }

    public function store (HardWarePriceRequest $request)
    {

        $data = HardWarePrice::create([
            'category'=>$request->str('title'),
            'title'=>$request->str("apple"),
            'sub_title'=>$request->str("apple"),
            'groupe'=>$request->integer("apple"),
            'description'=>$request->str('description'),
            'price'=>$request->input('price'),
        ]);
        return response()->json($data->id);
    }

    public function update (HardWarePriceRequest $request, HardWarePrice $hard)
    {

        if ($request->method() === 'PUT') {
            $hard -> update([
                'title'=>$request->str('title'),
                'apple'=>$request->str('apple'),
                'description'=>$request->str('description'),
                'price'=>$request->input('price'),
            ]);
        }else{
            $data = [];
            if ($request->has('title')) {
                $data['title'] = $request->input('title');
            }
            if ($request->has('apple')) {
                $data['apple'] = $request->input('apple');
            }
            if ($request->has('description')) {
                $data['description'] = $request->input('description');
            }
            if ($request->has('price')) {
                $data['price'] = $request->input('price');
            }

            $hard->update($data);
        }


        return response()->json([
            'id'=>$hard->id,
        ]);

    }

    public function destroy (HardWarePrice $hard)
    {
        $hard->delete();
        return ['message'=>'The item was deleted'];
    }
}
