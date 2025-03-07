<?php

namespace App\Http\Controllers\Price;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingLinePriceRequest;
use App\Models\SettingLinePrice;
use Illuminate\Http\Request;

class SettingLinePriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = SettingLinePrice::query()->get();
        return response()->json($data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(SettingLinePriceRequest $request)
    {
        $data = SettingLinePrice::create([
            'title'=>$request->str('title'),
            'description'=>$request->str('description'),
            'price'=>$request->input('price'),
        ]);
        return response()->json($data);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(SettingLinePriceRequest $request, SettingLinePrice $line)
    {
        if ($request->method() === 'PUT') {
            $line -> update([
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

            $line->update($data);
        }

        return response()->json([
            'id'=>$line->id,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SettingLinePrice $line)
    {
        $line->delete();
        return ['message'=>'The item was deleted'];
    }
}
