<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserPanelController extends Controller
{

    public function search(Request $request)
    {
       $validatedData = $request->validate([
            'q' => 'nullable|string',
            'category' => 'nullable|numeric|exists:categories,id',
           'based_on' => 'nullable|in:latest,most-favorite',
       ]);


        $query = DB::table('books')
                ->select('books.id', 'books.judul', 'books.penulis', 'books.img_cover', DB::raw('COUNT(book_read_history.id) as number_of_reads'))
                ->leftJoin('book_read_history', 'books.id', '=', 'book_read_history.book_id')
                ->groupBy('books.id');

        // Search for books by judul
        if ($request->has('q')) {
            $query->where('judul', 'like', '%'.$request->q.'%');
        }

        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        // Sort the books based on the 'based_on' parameter
        switch ($request->based_on) {
            case 'latest':
                $query->orderBy('books.created_at', 'desc');
                break;
            case 'most-favorite':
                $query->orderBy('number_of_reads', 'desc');
                break;
        }
        
        $categories = Category::get();
        $books = $query->paginate(16);


        return view('user.books.search', compact('categories', 'books'));
        // return response()->json($books);
    }

    public function show(Request $request, Book $book)
    {
        $book = Book::findOrFail($request->id);
        $number_of_reads = DB::table('book_read_history')
                            ->select('id')
                            ->where('book_id', '=', $request->id)
                            ->count();

        $is_favorite = DB::table('favorites')
                        ->select('id')
                        ->where('user_id', '=', Auth::id())
                        ->where('book_id', '=', $request->id)
                        ->count();
        if($is_favorite == 0) {
            $is_favorite = false;
        } elseif($is_favorite == 1) {
            $is_favorite = true;
        }

        
        $reviews = DB::table('reviews')
                    ->select('reviews.*', 'users.name', 'users.created_at as joined_at')
                    ->where('reviews.book_id', '=', $request->id)
                    ->join('users', 'reviews.user_id', '=', 'users.id');
        $book_rate = $reviews->avg('star');
        $reviews = $reviews->take(5)->get();
        if(count($reviews) == 0) {
            $book_rate = 0;
        }

        $related_books = Book::where('category_id', $book->category_id)->inRandomOrder()->take(5)->get();

        return view('user.books.book', compact('book', 'is_favorite', 'reviews', 'book_rate', 'number_of_reads', 'related_books'));
    }

    public function authors()
    {
        $authors = DB::table('books')
                    ->select('authors.name','authors.id')
                    ->join('authors', 'authors.name', '=', 'books.penulis')
                    ->distinct()
                    ->get();

        $authorsByLetter = [];
        foreach ($authors as $author) {
            // dd($author);
            $firstLetter = strtoupper(substr($author->name, 0, 1));
            if (!isset($authorsByLetter[$firstLetter])) {
                $authorsByLetter[$firstLetter] = [];
            }
            $authorsByLetter[$firstLetter][] = [
                'name' => $author->name,
                'id' => $author->id
            ];
        }
        
        return view('user.books.authors', [
            'authors' => $authorsByLetter,
        ]);
    }

    public function author(Request $request)
    {
        $books = DB::table('authors')
                    ->select('books.*', 'authors.id as aid')
                    ->join('books', 'books.penulis', '=', 'authors.name')
                    ->where('authors.id', '=', $request->id)
                    ->get();
        $author = DB::table('authors')
                    ->select('authors.name')
                    ->where('id', '=', $request->id)
                    ->get();
        return view('user.books.author', compact('books', 'author'));
    }

    public function publishers()
    {
        $publishers = DB::table('books')
                    ->select('publishers.name','publishers.id')
                    ->join('publishers', 'publishers.name', '=', 'books.penerbit')
                    ->distinct()
                    ->get();

        $publishersByLetter = [];
        foreach ($publishers as $publisher) {
            $firstLetter = strtoupper(substr($publisher->name, 0, 1));
            if (!isset($publishersByLetter[$firstLetter])) {
                $publishersByLetter[$firstLetter] = [];
            }
            $publishersByLetter[$firstLetter][] = [
                'name' => $publisher->name,
                'id' => $publisher->id
            ];
        }
        
        return view('user.books.publishers', [
            'publishers' => $publishersByLetter,
        ]);
    }

    public function publisher(Request $request)
    {
        $books = DB::table('publishers')
                    ->select('books.*', 'publishers.id as aid')
                    ->join('books', 'books.penerbit', '=', 'publishers.name')
                    ->where('publishers.id', '=', $request->id)
                    ->get();
                    
        $publisher = DB::table('publishers')
                    ->select('publishers.name')
                    ->where('id', '=', $request->id)
                    ->get();
        return view('user.books.publisher', compact('books', 'publisher'));
    }

    
    
}
