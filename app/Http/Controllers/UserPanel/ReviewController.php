<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $reviews = DB::table('reviews')
                    ->select('reviews.*', 'users.name', 'users.photo', 'users.created_at as joined_at')
                    ->where('reviews.book_id', '=', $request->id)
                    ->join('users', 'reviews.user_id', '=', 'users.id')
                    ->get();
        $book = Book::where('id', '=', $request->id)->first();
        return view('user.books.reviews', compact('reviews', 'book'));
    }

    public function store(Request $request)
    {
        $singleReview = DB::table('reviews')->select('id')->where('book_id', '=', $request->book_id)->where('user_id', '=', Auth::id())->get();
        if(count($singleReview) > 0) {
            return redirect()->back()->withErrors(['multipleReview' => 'Penilaian gagal. Anda sudah memberikan ulasan untuk buku ini.']);
        }
        $review = new Review();
        $review->user_id = Auth::id();
        $review->book_id = $request->book_id;
        $review->star = $request->rating;
        $review->review = $request->review;
        $review->save();
        return redirect()->back();
    }
}
