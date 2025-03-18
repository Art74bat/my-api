<?php

namespace App\Http\Controllers;

use App\Http\Resources\Reviews\ReviewseResource;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index ()
    {
        $review = Review::query()->get();
        return ReviewseResource::collection($review);

    }

    public function show (Review $review)
    {
        return new ReviewseResource($review);
    }
    public function store (Request $request)
    {
        // dd($request);
        $fields = $request->validate([
            'name'=>'required|max:225',
            // 'second_name'=>'required|max:225',
            'email'=>'required|email',
            "review"=>'max:225',
        ]);

        Review::create($fields);
        return response()->json([
            "message"=>"Отзыв успешно создан !"
        ]);
    }
    public function destroy(Review $review)
    {
        // dd($call);
        $review->delete();

        return ['message'=>'The review was deleted'];
    }
}
