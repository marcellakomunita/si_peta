<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'key' => ['string', 'max:255']
        ]); 
        
        $books = Book::has('reviews')
                ->where(function ($query) use ($request) {
                    if (($key = $request->key)) {
                        $query->orWhere('judul', 'LIKE', '%' . $key . '%');
                    }
                })
                ->withCount('reviews')
                ->orderBy('updated_at', 'desc')
                ->paginate(20);
                
        return view('admin.reviews.index', compact('books'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $reviews = Review::with(['user:id,name,photo,created_at'])
                    ->whereHas('user', function($query) use ($request) {
                        if (($key = $request->key)) {
                            $query->where('name', 'LIKE', '%' . $key . '%');
                        }
                    })
                    ->where('book_id', $request->id)
                    ->paginate(20);
        return view('admin.reviews.show', compact('reviews'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $review = Review::findOrFail($request->id);
        $review->delete();
        return redirect()->route('admin.reviews.show', ['id'=>$request->id]);
    }
}
