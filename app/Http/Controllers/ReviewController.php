<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index ()
    {
        $review = Review::query()->get();
        return response()->json($review);
    }

    public function show (Review $review)
    {
        return $review;
    }
    public function store (Request $request)
    {
        // dd($request);
        $fields = $request->validate([
            'name'=>'required|max:225',
            'second_name'=>'string',
            'email'=>'required|email',
            "review"=>'max:225',
            'policy'=>'boolean',
        ]);

        // dd($request);
        $review = Review::create($fields);
        return response()->json([
            "id"=>$review->id
        ]);
    }
    public function destroy(Review $review)
    {
        // dd($call);
        $review->delete();

        return ['message'=>'The review was deleted'];
    }
}
