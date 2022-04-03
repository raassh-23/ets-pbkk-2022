<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:10',
            'review' => 'required|string'
        ]);

        $review = Review::create([
            'rating' => $request->rating,
            'review' =>  $request->review,
            'user_id' => $request->user()->id,
            'book_id' => $request->book_id
        ]);

        if ( $review ) {
            return redirect()->back()->with([
                'success' => 'Review berhasil ditambahkan',
            ]);
        }
        return redirect()->back()->with([
            'error' => 'Review tidak berhasil ditambahkan',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:10',
            'review' => 'required|string'
        ]);

        $review->update([
            'rating' => $request->rating,
            'review' =>  $request->review,
        ]);

        if ( $review ) {
            return redirect()->back()->with([
                'success' => 'Review berhasil diubah',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        if ($review->user->id == Auth::user()->id) {
            $review->delete();
            return redirect()->back()->with([
                'success' => 'Review berhasil dihapus',
            ]);
        }
    }
}
