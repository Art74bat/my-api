<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\Post\PostService;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Requests\PostStoreRequest;
use App\Http\Resources\Post\PostMiniResource;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;


// use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
// use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller implements HasMiddleware
{
    public static function middleware (){
        return [
            new Middleware('auth:sanctum',except:['index','show'])
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(PostService $services)
    {
        return PostMiniResource::collection($services->published());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostStoreRequest $request, PostService $service)
    {
        $post = $service->store($request);

        return response()->json([
            ['id'=>$post->id],
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, Post $post, PostService $service)
    {
        $service->setPost($post)->update($request);
        
        return response()->json([
            ['id'=>$post->id],
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //  receive image
        $images = $post->images;
        // delete image from localDisk
        foreach ($images as $image) {
            $file = basename($image->path);
            Storage::disk('local')->delete('images/'.$file);
        }
        
        // delete post
        $post->delete();
        return ['message'=>'The post was deleted'];
    }
}
