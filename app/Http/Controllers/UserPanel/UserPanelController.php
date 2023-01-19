<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserPanelController extends Controller
{
    public function categories()
    {   
        return view('user.books.categories');
    }

    public function book()
    {
        return view('user.books.book');
    }
}
