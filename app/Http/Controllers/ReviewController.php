<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "content" => "required"
        ]);

        $review = new Review();
        $review->content = $request->input("content");
        $review->user_id = Auth::user()->id;
        $review->item_id = $request->input("item_id");
        $review->score = $request->input("score");
        $review->save();

        return back();

    }

    /**
     * Display the specified resource.
     */
   
}
