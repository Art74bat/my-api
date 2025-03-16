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
            'title'=>$request->str('title'),
            'description'=>$request->str('description'),
            'price'=>$request->input('price'),
        ]);
        return response()->json($data->id);
    }

    public function update (PriceRequest $request, CorporatePrice $item)
    {

        if ($request->method() === 'PUT') {
            $item -> update([
                'title'=>$request->title,
                'description'=>$request->description,
                'price'=>$request->price,
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

    public function destroy (CorporatePrice $item)
    {
        $item->delete();
        return ['message'=>'The item was deleted'];
    }
}
