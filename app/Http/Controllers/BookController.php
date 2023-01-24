<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $books = Book::where([
            [function ($query) use ($request) {
                if (($key = $request->key)) {
                    $query->orWhere('judul', 'LIKE', '%' . $key . '%')
                        ->orWhere('penulis', 'LIKE', '%' . $key . '%')
                        ->get();
                }
            }]
        ])->paginate(10);
        return view('admin.books.index', [
            'books' => $books,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            if ($request->file_ebook && $request->img_cover) {

                $request->validate([
                    'file_ebook' => 'required|mimes:pdf|max:2048',
                    'image_cover' => 'required|mimes:png,jpg,jpeg|max:2048',
                ]);

                DB::beginTransaction();

                $author = DB::table('author')->where('name', $request->penulis)->first();
                if (!$author) {
                    $author = new Author();
                    $author->name = $request->penulis;
                    $author->save();
                }
                
                $book = new Book();
                $id = Str::random(16);
                // $filePath = $request->file('file_ebook')->storeAs('uploads', $fileName, 'public');

                $book->id = $id;
                // $book->category_id = $request->category_id;
                $book->isbn = $request->isbn;
                $book->judul = $request->judul;
                $book->penulis = $request->penulis;
                $book->penerbit = $request->penerbit;
                $book->sinopsis = $request->sinopsis;
                $book->tgl_terbit = $request->tgl_terbit;
                $book->file_ebook = 'x';
                $book->img_cover = 'x';
                $book->save();


                $file = $request->file('file_ebook');
                $pathB = 'E:/hbooks-wrty/' .$book->id . '.' . $file->extension();
                move_uploaded_file($file->getRealPath(), $pathB);
                
                
                $file = $request->file('img_cover');
                $pathC = 'E:/hpics-cjpeb/' .$book->id . '.' . $file->extension();
                move_uploaded_file($file->getRealPath(), $pathC);

                DB::table('books')->where('id', $book->id)->update([
                    'file_ebook' => $pathB,
                    'img_cover' => $pathC
                ]);

                return redirect('admin/books/');
            }
            
            else {
                return back()->withInput()->withErrors(['error'=>'Field belum semua terisi.']);
            }
            
        } catch (QueryException $ex) {
            if ($ex->errorInfo[1] == 2300) {
                return back()->withInput()->withErrors(['error'=>'Penyimpanan gagal, mohon ulang sesaat lagi.']);
            }
            else if ($ex->errorInfo[1] == 2627) {
                return back()->withInput()->withErrors(['error'=>'ISBN sudah terdaftar!']);
            }
            else {
                dd($ex->errorInfo[1]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        return view('admin.books.edit', [
            'book' => $book,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        try {
            $book = Book::find($request->id);
            $book->isbn = $request->isbn;
            $book->judul = $request->judul;
            $book->penulis = $request->penulis;
            $book->penerbit = $request->penerbit;
            $book->sinopsis = $request->sinopsis;
            $book->tgl_terbit = $request->tgl_terbit;

            if ($request->file_ebook && $request->img_cover) {
                unlink($book->file_ebook);
                $file = $request->file('file_ebook');
                $pathB = 'E:/hbooks-wrty/' .$book->id . '.' . $file->extension();
                move_uploaded_file($file->getRealPath(), $pathB);

                unlink($book->img_cover);
                $file = $request->file('img_cover');
                $pathC = 'E:/hpics-cjpeb/' .$book->id . '.' . $file->extension();
                move_uploaded_file($file->getRealPath(), $pathC);
            }

            $book->save();
        } catch (QueryException $ex) { 
            dd($ex->errorInfo[1]);
        }  

        return redirect('/admin/books/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Book $book)
    {
        $book = Book::find($request->id);
        // dd($book->file_ebook);
        if (file_exists($book->file_ebook)) {
            unlink($book->file_ebook);
        }
        if (file_exists($book->img_cover)) {
            unlink($book->img_cover);
        }
        $book->delete();
        return redirect('/admin/books');
    }
}
