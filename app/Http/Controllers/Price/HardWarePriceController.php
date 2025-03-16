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
        // dd($request);

        $data = HardWarePrice::create([
            'category'=>$request->str('category'),
            'title'=>$request->input("title"),
            'sub_title'=>$request->input("sub_title"),
            'groupe'=>$request->str("groupe"),
            'description'=>$request->str('description'),
            'price'=>$request->input('price'),
        ]);
        return response()->json($data->id);
    }

    public function update (HardWarePriceRequest $request, HardWarePrice $hard)
    {
        // dd($request);
        if ($request->method() === 'PUT') {
            $hard -> update([
                'category'=>$request->str('category'),
                'title'=>$request->input('title'),
                'sub_title'=>$request->str('sub_title'),
                'groupe'=>$request->str('groupe'),
                'description'=>$request->str('description'),
                'price'=>$request->input('price'),
            ]);
        }else{
            $data = [];
            if ($request->has('category')) {
                $data['category'] = $request->input('category');
            }
            if ($request->has('title')) {
                $data['title'] = $request->input('title');
            }
            if ($request->has('sub_title')) {
                $data['sub_title'] = $request->input('sub_title');
            }
            if ($request->has('groupe')) {
                $data['groupe'] = $request->input('groupe');
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
        return ['message'=>'Данные были удалены !'];
    }
}
