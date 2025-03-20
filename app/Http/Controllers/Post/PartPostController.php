<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PartBodyRequest;
use App\Models\PostBody;
// use Illuminate\Http\Request;

class PartPostController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(PartBodyRequest $request,$id)
    {
        $body = PostBody::create([
            'post_id' => $id,
            'sub_title' => $request->input('sub_title'),
            'body' => $request->input('body'),
        ]);

        return response()->json([
            ['id'=>$body->id],
        ],201);
    }
}
