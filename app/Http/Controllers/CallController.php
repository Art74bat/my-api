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
            'email'=>'email',
            "message"=>'max:225',
            'phone'=>'string',
            'calls'=>'boolean'
        ]);
        $call = Call::create($fields);
        return response()->json([
            "message"=>"Данные успешно отправлены !"
        ]);
    }
    public function destroy(Call $call)
    {
        // dd($call);
        $call->delete();

        return ['message'=>'Сообщение было удалено !'];
    }
}
