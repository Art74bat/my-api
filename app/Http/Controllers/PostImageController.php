<?php

namespace App\Http\Controllers;

use App\Models\PostImage;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Exists;
use function PHPUnit\Framework\returnArgument;
use Illuminate\Support\Facades\Gate;

class PostImageController extends Controller
{
    // public function index ()
    // {
    //     $images = PostImage::query()->select(['path','post_id'])->get();
    //     // return $images;

    //     return $images->map(fn(PostImage $image)=>[
    //         'post'=>$image->post->title,
    //         'path'=>$image->path,
    //     ]);
    // }


    public function update(Request $request, $id) 
    {  

        $images = PostImage::query()->where('post_id',$id)->get(['id','path']);
        // dd($images);
        if (PostImage::where('post_id',$id)->exists()) {
            foreach ($images as $image) {
                $file = basename($image->path);
                // dd($image->post_id);
                Storage::disk('local')->delete('images/'.$file);
                $image->delete();
            }
        }

        if ($request->file('images')) {
        foreach ($request->file('images') as $item) {
            $path = $item->storePublicly('images');
            // dd($request->id);
            PostImage::create([
                'post_id'=>$request->id,
                'path'=>config('app.url'). Storage::url($path),               
            ]);
        }
        } else {
            return response()->json([
                'message' => 'file not load'
            ]);
        }

        return response()->json($images);

    }
    
}
