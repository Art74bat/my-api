<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Call;;

class CallController extends Controller
{
    public function index ()
    {
        $call = Call::query()->get();
        return response()->json($call);
    }

    public function show (Call $call)
    {
        return $call;
    }
    public function store (Request $request)
    {
        // dd($request);
        $fields = $request->validate([
            'name'=>'required|max:225',
            'email'=>'required|email',
            "message"=>'max:225',
            'phone'=>'required',
            'consult'=>'required'
        ]);
        $call = Call::create($fields);
        return response()->json([
            "id"=>$call->id
        ]);
    }
    public function destroy(Call $call)
    {
        // dd($call);
        $call->delete();

        return ['message'=>'Сообщение было удалено !'];
    }
}
