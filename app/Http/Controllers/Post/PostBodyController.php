<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\Models\PostBody;

class PostBodyController extends Controller
{
      /**
     * создать дополнительный раздел Post
     *
     * @param  int  $id
     * @return Response
     */
    public function __invoke(PostStoreRequest $request,$id)
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
