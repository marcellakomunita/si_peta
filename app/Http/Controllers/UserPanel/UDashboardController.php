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
        $latest_books = $books->orderBy('created_at', 'desc')->take(5)->get();
        $favorite_books = $books->select('books.*', DB::raw('COUNT(book_read_history.id) as number_of_reads'))
                                ->leftJoin('book_read_history', 'books.id', '=', 'book_read_history.book_id')
                                ->groupBy('books.id');
        $favorite_books->getQuery()->orders = null;
        $favorite_books = $favorite_books
                                ->orderBy('number_of_reads', 'desc')
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
