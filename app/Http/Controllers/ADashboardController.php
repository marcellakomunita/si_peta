<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\LoginHistories;
use App\Models\User;
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
        $numVisitors = LoginHistories::count();

        $visitorData = $this->visitorData();
        
        return view('admin.dashboard', [
            'numUsers' => $numUsers,
            'numAdmins' => $numAdmins,
            'numBooks' => $numBooks,
            'numCategories' => $numCategories,
            'numVisitors' => $numVisitors,
            'visitorData' => $visitorData,
        ]);
    }

    public function visitorData()
    {
        $visitorData = LoginHistories::select(DB::raw('DATE_FORMAT(login_at, "%Y-%m") as month'), DB::raw('COUNT(*) as count'))
                    ->groupBy(DB::raw('DATE_FORMAT(login_at, "%Y-%m")'))
                    ->get();
        return $visitorData;
    }
}
