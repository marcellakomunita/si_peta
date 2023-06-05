<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use App\Models\Favorites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserFavoritesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    $favorites = DB::table('favorites')
        ->select('favorites.id as fid', 'books.id', 'books.judul', 'books.img_cover', DB::raw('GROUP_CONCAT(authors.name SEPARATOR ", ") as name'))
        ->leftJoin('books', 'favorites.book_id', '=', 'books.id')
        ->leftJoin('books_authors', 'books.id', '=', 'books_authors.book_id')
        ->leftJoin('authors', 'books_authors.author_id', '=', 'authors.id')
        ->where('favorites.user_id', '=', Auth::id())
        ->groupBy('favorites.id', 'books.id', 'books.judul', 'books.img_cover')
        ->get();

    return view('user.books.favorites', compact('favorites'));
}



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $singleFave = DB::table('favorites')->select('id')->where('book_id', '=', $request->book_id)->where('user_id', '=', Auth::id())->get();
        if(count($singleFave) > 0) {
            return redirect()->back()->withErrors(['sameBook' => 'Buku ini sudah ditambahkan ke daftar favorit Anda.']);
        }
        $favorite = Favorites::where('book_id', $id)->where('user_id', Auth::id())->first();
        if($favorite) {
            return back()->with('error', 'This book is already in your favorites');
        }

        $favorite = new Favorites();
        $favorite->user_id = Auth::id();
        $favorite->book_id = $id;
        $favorite->save();

        return back()->with('success', 'book added');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Favorites $favorite)
    {
        $favorite = Favorites::findOrFail($request->id);
        if ($favorite->user_id != Auth::id()) {
            return back()->with('error', 'You can only remove your own favorites');
        }

        // Remove the favorite
        $favorite->delete();

        return back()->with('success', 'Book removed from your favorites');
    }

    public function toggle(Request $request)
    {
        $bookId = $request->input('book_id');
        $userId = Auth::id();

        $favorite = Favorites::where('book_id', $bookId)->where('user_id', $userId)->first();
        if ($favorite) {
            $favorite->delete();
            return response()->json(['status' => 'removed']);
        } else {
            $favorite = new Favorites();
            $favorite->user_id = $userId;
            $favorite->book_id = $bookId;
            $favorite->save();
            return response()->json(['status' => 'added']);
        }
    }

    public function isFavorite($id)
    {
        $favorite = Favorites::where('book_id', $id)->where('user_id', Auth::id())->first();

        if ($favorite) {
            return response()->json(['is_favorite' => true]);
        }

        return response()->json(['is_favorite' => false]);
    }
}
