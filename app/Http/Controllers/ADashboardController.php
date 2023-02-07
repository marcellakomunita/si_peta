<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\LoginHistories;
use App\Models\User;
use App\Models\VisitHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ADashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $numUsers = User::where('type', 0)->count();
        $numAdmins = User::where('type', 1)->count();
        $numBooks = Book::count();
        $numCategories = Category::count();
        // $numVisitors = LoginHistories::whereHas('user', function ($query) {
        //                     $query->where('type', 0);
        //                 })->count();
        $numVisitors = VisitHistory::count();

        $now = Carbon::now();
        $favoriteBooks = Book::query()
                            ->select('books.*', DB::raw('COUNT(book_read_history.id) as number_of_reads'))
                            ->leftJoin('book_read_history', 'books.id', '=', 'book_read_history.book_id')
                            ->whereMonth('book_read_history.read_at', $now->month)
                            ->whereYear('book_read_history.read_at', $now->year)
                            ->groupBy('books.id')
                            ->orderBy('number_of_reads', 'desc')
                            ->take(5)
                            ->get();

        $booksDist = Category::select('name', DB::raw('COUNT(books.id) as number_of_books'))
                        ->leftJoin('books', 'categories.id', '=', 'books.category_id')
                        ->orderBy('number_of_books', 'desc')
                        ->groupBy('categories.name')
                        ->get();

        $favoriteCategories = DB::table('book_read_history')
                                ->join('books', 'book_read_history.book_id', '=', 'books.id')
                                ->join('categories', 'books.category_id', '=', 'categories.id')
                                ->whereMonth('book_read_history.read_at', $now->month)
                                ->whereYear('book_read_history.read_at', $now->year)
                                ->select('categories.name', DB::raw('count(*) as read_count'))
                                ->groupBy('categories.name')
                                ->orderBy('read_count', 'desc')
                                ->take(5)
                                ->get();

        $visitorData = $this->visitorData();
        
        return view('admin.dashboard', compact(
            'numUsers', 'numAdmins', 'numBooks', 'numCategories', 
            'numVisitors', 'visitorData',
            'favoriteBooks', 
            'favoriteCategories', 
            'booksDist', 
        ));
    }

    public function visitorData()
    {
        // $visitorData = LoginHistories::select(DB::raw('DATE_FORMAT(login_at, "%Y-%m") as month'), DB::raw('COUNT(*) as count'))
        //                 ->groupBy(DB::raw('DATE_FORMAT(login_at, "%Y-%m")'))
        //                 ->get();

        $visitorData = VisitHistory::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'), DB::raw('COUNT(*) as count'))
                        ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'))
                        ->get();

        return $visitorData;
    }
}
