<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UReviewController extends Controller
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

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'rating' => ['required', 'integer', 'between:1,5'],
            'review' => ['nullable', 'string', 'max:800']
        ], [
            'rating.between' => 'This rate field is required'
        ]);
    }

    public function store(Request $request)
    {
        $validator = $this->validator($request->all());

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

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
