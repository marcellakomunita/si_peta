<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookImage;
use App\Models\BookReadHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BookRController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'bid' => ['required', 'string', 'min:16', 'max:16'],
            'uid' => ['required', 'string', 'min:1'],
        ]);
    }

    public function index(Request $request)
    {
        $book = Book::findOrFail($request->id);
        $files = 'x';
        if ($book->file_ebook == 'x') {
            $files = BookImage::where('book_id', $book->id)->get();
        }
        return view('user.books.read', compact('book', 'files'));
    }

    public function store(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::table('book_read_history')->insert([
            'book_id' => $request->bid,
            'user_id' => $request->uid,
            'read_at' => now(),
        ]);

        // $readHistory = new BookReadHistory();
        // $readHistory->user_id = $request->uid;
        // $readHistory->book_id = $request->bid;
        // $readHistory->save();

        return redirect()->to('/bookr?id=' . $request->bid);
    }
}
