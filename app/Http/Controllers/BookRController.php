<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookRController extends Controller
{
    public function user()
    {
        
        return view('user.books.read');
    }
}
