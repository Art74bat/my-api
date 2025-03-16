<?php

namespace App\Http\Controllers\Price;

use App\Http\Controllers\Controller;
use App\Http\Requests\CorpPriceRequest;
use App\Http\Resources\Price\CorpPriceResource;
use App\Models\CorporatePrice;
use Illuminate\Http\Request;

class CorporatePriceController extends Controller
{
    public function index ()
    {
        $data = CorporatePrice::query()->get();
        return CorpPriceResource::collection($data);
    }

    public function store (CorpPriceRequest $request)
    {
        $data = CorporatePrice::create([
            'category'=>$request->str('category'),
            'description'=>$request->str('description'),
            'route'=>$request->str('route'),
            'price'=>$request->input('price'),
        ]);
        return response()->json([
            'message'=>'Даннуе успешно добавлены !'
        ]);
    }

    public function update (CorpPriceRequest $request, CorporatePrice $item)
    {

        if ($request->method() === 'PUT') {
            $item -> update([
                'category'=>$request->category,
                'description'=>$request->description,
                'route'=>$request->route,
                'price'=>$request->price,
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

            $item->update($data);
        }


        return response()->json([
            'id'=>$item->id,
        ]);

    }

    public function destroy (CorporatePrice $item)
    {
        $item->delete();
        return ['message'=>'Данные удалены !'];
    }
}
