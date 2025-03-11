<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index ()
    {
        $devices = Device::query()->get();

        return $devices->map(fn($item)=>[
            'id'=>$item->id,
            'name'=>$item->name,
        ]);
    }

    public function show (Device $device)
    {
        return $device;
    }
    public function store (Request $request)
    {
        // dd($request);
        $fields = $request->validate([
            'name'=>'required|string|max:225',
        ]);

        $device = Device::create($fields);

        return response()->json([
            'message'=>'Устройство добавлено !',
            "id"=>$device->id
        ]);
    }
    public function destroy(Device $device)
    {
        $device->delete();
        return ['message'=>'The device was deleted'];
    }
}
