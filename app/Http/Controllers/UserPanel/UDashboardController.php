<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UDashboardController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {     
        $books = Book::query();
        $sliders = Slider::get();
        $categories = Category::get();
        $latest_books = $books->select('books.*', DB::raw('GROUP_CONCAT(a.name) as authors'))
            ->leftJoin('books_authors as ba', 'books.id', '=', 'ba.book_id')
            ->leftJoin('authors as a', 'ba.author_id', '=', 'a.id')
            ->groupBy('books.id')
            ->orderBy('books.created_at', 'desc')
            ->take(5)
            ->get();

        $favorite_books = $books->select('books.*', DB::raw('GROUP_CONCAT(authors.name) as authors'), DB::raw('COUNT(book_read_history.id) as number_of_reads'))
            ->leftJoin('book_read_history', 'books.id', '=', 'book_read_history.book_id')
            ->leftJoin('books_authors', 'books.id', '=', 'books_authors.book_id')
            ->leftJoin('authors', 'books_authors.author_id', '=', 'authors.id')
            ->groupBy('books.id')
            ->orderBy('number_of_reads', 'desc')
            ->take(5)
            ->get();


        return view('user.home', compact('sliders', 'categories', 'latest_books', 'favorite_books'));
    }

    public function profile()
    {
        return view('user.profile');
    }

    public function aboutus()
    {
        return view('user.about-us');
    }
}
