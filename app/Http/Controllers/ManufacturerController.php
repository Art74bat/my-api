<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
{
    public function index ()
    {
        $manufacturers = Manufacturer::query()->get();
        
        return $manufacturers->map(fn( $item)=>[
            'id'=>$item->id,
            'name'=>$item->name
        ],);
    }

    // public function show (Manufacturer $manufacturer)
    // {
    //     return $manufacturer;
    // }

    public function store (Request $request)
    {
        // dd($request);
        $fields = $request->validate([
            'name'=>'required|string|max:225',
        ]);

        $manufacturer = Manufacturer::create($fields);
        return response()->json([
            "id"=>$manufacturer->id
        ]);
    }
    public function destroy(Manufacturer $manufacturer)
    {

        $manufacturer->delete();

        return ['message'=>'The device was deleted'];
    }
}
