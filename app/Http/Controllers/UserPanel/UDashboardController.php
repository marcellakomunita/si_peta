<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class UDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {     
        $favoriteBooks = Book::get();
        return view('user.home', [
            'favoriteBooks' => $favoriteBooks,
        ]);
    }

    public function profile()
    {
        return view('user.profile');
    }
}
