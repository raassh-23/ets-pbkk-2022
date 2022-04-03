<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Book $book, Request $request)
    {
        if ($book->reviews()->where('user_id', $request->user()->id)->exists()) {
            return redirect()->back()->with([
                'error' => 'Adding review failed. You already reviewed this book.',
            ]);
        }
        
        $request->validate([
            'rating' => 'required|integer|min:1|max:10',
            'review' => 'required|string',
        ]);

        $review = $book->reviews()->create([
            'rating' => $request->rating,
            'review' =>  $request->review,
            'user_id' => $request->user()->id,
        ]);

        if ($review) {
            return redirect()->back()->with([
                'success' => 'Review added successfully.',
            ]);
        }

        return redirect()->back()->with([
            'error' => 'Adding review failed.',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Book $book, Request $request, Review $review)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:10',
            'review' => 'required|string',
        ]);

        $review->update([
            'rating' => $request->rating,
            'review' =>  $request->review,
        ]);

        if ( $review ) {
            return redirect()->back()->with([
                'success' => 'Review changed successfully.',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book, Review $review)
    {
        if ($review->user->id == Auth::user()->id) {
            $review->delete();
            return redirect()->back()->with([
                'success' => 'Review deleted successfully.',
            ]);
        }
    }

    public function indexAdmin() 
    {
        // 
    }
}
