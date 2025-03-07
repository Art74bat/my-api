<?php

namespace App\Http\Controllers\Services\Post;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostService
{
    private Post $post;
    public function published ()
    {
        return Post::query()->get();
    }

    public function store (PostStoreRequest $request):Post
    {
         // dd($request);
         $post = $request->user()->posts()->create([
            'title'=>$request->str('title'),
        ]);

        $post->body()->create([
            'sub_title'=>$request->str('sub_title'),
            'body'=>$request->str('body'),
        ]);

        foreach ($request->file('images') as $item) {
            $path = $item->storePublicly('images');
            // dd($path);

            $post->images()->create([
                'path'=>config('app.url'). Storage::url($path)
            ]);
        }
        
        return $post;
    }

    public function update (PostUpdateRequest $request)
    {
        
        $this->post->update([
            'title'=>$request->input('title'),
        ]); 
        $this->post->body()->update([
            "sub_title"=>$request->input('sub_title'),
            "body"=>$request->input('body'),
        ]);


        return $this->post;
    }

    public function setPost(Post $post)
    {
        $this->post = $post;
        return $this;
    }
}
