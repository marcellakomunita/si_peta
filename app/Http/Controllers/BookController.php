<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use PDOException;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'key' => ['string', 'max:255']
        ]);

        $books = Book::where([
            [function ($query) use ($request) {
                if (($key = $request->key)) {
                    $query->orWhere('judul', 'LIKE', '%' . $key . '%')
                        ->orWhere('penulis', 'LIKE', '%' . $key . '%')
                        ->get();
                }
            }]
        ])->orderBy('updated_at', 'desc')->paginate(10);
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
        $categories = Category::get();
        return view('admin.books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function imgvalidator(array $data)
    {
        return Validator::make($data, [
            'user_photo' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);
    }

    protected function pdfvalidator(array $data)
    {
        return Validator::make($data, [
            'file_ebook' => 'mimes:pdf|max:2048'
        ]);
    }
    public function store(Request $request)
    {
        try {
            if ($request->file('file_ebook') && $request->file('img_cover')) {

                $request->validate([
                    'isbn' => ['required', 'string', 'min:17', 'max:18', Rule::unique('books')],
                    'judul' => ['required', 'string', 'max:255'],
                    'kategori' => ['required', 'string', 'min:3', 'max:4'],
                    'penulis' => ['required', 'string', 'max:255'],
                    'penerbit' => ['required', 'string', 'max:255'],
                    'sinopsis' => ['required', 'string', 'max:800'],
                    'tgl_terbit' => ['required']
                ]);

                $pdfvalidator = $this->pdfvalidator([$request->file('file_ebook')]);
                if ($pdfvalidator->fails()) {
                    return redirect()->back()
                        ->withErrors($pdfvalidator)
                        ->withInput();
                }

                $imgvalidator = $this->imgvalidator([$request->file('img_cover')]);
                if ($imgvalidator->fails()) {
                    return redirect()->back()
                        ->withErrors($imgvalidator)
                        ->withInput();
                }
                
                try {
                    DB::beginTransaction();

                    $author = DB::table('authors')->where('name', $request->penulis)->first();
                    if (!$author) {
                        $author = new Author();
                        $author->name = $request->penulis;
                        $author->save();
                    }
                    
                    $publisher = DB::table('publishers')->where('name', $request->penerbit)->first();
                    if (!$publisher) {
                        $publisher = new Publisher();
                        $publisher->name = $request->penerbit;
                        $publisher->save();
                    }

                    $book = new Book();
                    $id = Str::random(16);
                    // $filePath = $request->file('file_ebook')->storeAs('uploads', $fileName, 'public');
    
                    $book->id = $id;
                    $book->category_id = $request->kategori;
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

                    DB::commit();
    
                    return redirect('admin/books/');
                } catch (PDOException $e) {
                    // Woopsy
                    DB::rollBack();
                }               
               
            }
            
            elseif($request->file('file_ebook')) {
                return back()->withInput()->withErrors(['file_ebook'=>'Field belum semua terisi.']);
            }

            elseif($request->file('img_cover')) {
                return back()->withInput()->withErrors(['img_cover'=>'Field belum semua terisi.']);
            }

            else {
                return back()->withInput()->withErrors(['img_cover'=>'Field belum semua terisi.', 'file_ebook'=>'Field belum semua terisi.']);
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
        $categories = Category::get();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $book = Book::find($request->id);

            $request->validate([
                'isbn' => ['required', 'string', 'min:17', 'max:18', Rule::unique('books')->ignore($request->isbn, 'isbn')],
                'judul' => ['required', 'string', 'max:255'],
                'kategori' => ['required', 'string', 'min:3', 'max:4'],
                'penulis' => ['required', 'string', 'max:255'],
                'penerbit' => ['required', 'string', 'max:255'],
                'sinopsis' => ['required', 'string', 'max:800'],
                'tgl_terbit' => ['required']
            ]);
            
            $book->category_id = $request->kategori;
            $book->isbn = $request->isbn;
            $book->judul = $request->judul;
            $book->penulis = $request->penulis;
            $book->penerbit = $request->penerbit;
            $book->sinopsis = $request->sinopsis;
            $book->tgl_terbit = $request->tgl_terbit;

            
            if ($request->file('file_ebook')) {
                $pdfvalidator = $this->pdfvalidator([$request->file('file_ebook')]);
                if ($pdfvalidator->fails()) {
                    return redirect()->back()
                        ->withErrors($pdfvalidator)
                        ->withInput();
                }

                if(!is_null($book->file_ebook) && file_exists($book->img_cover)) {
                    unlink($book->file_ebook);
                }

                $file = $request->file('file_ebook');
                $pathB = 'E:/hbooks-wrty/' .$book->id . '.' . $file->extension();
                move_uploaded_file($file->getRealPath(), $pathB);

                $book->file_ebook = $pathB;
            } 
            // else {
            //     return back()->withInput()->withErrors(['file_ebook'=>'Field belum semua terisi.']);
            // }

            if ($request->file('img_cover')) {
                $imgvalidator = $this->imgvalidator([$request->file('img_cover')]);
                if ($imgvalidator->fails()) {
                    return redirect()->back()
                        ->withErrors($imgvalidator)
                        ->withInput();
                }

                if(!is_null($book->img_cover) && file_exists($book->img_cover)) {
                    unlink($book->img_cover);
                }

                $file = $request->file('img_cover');
                $pathC = 'E:/hpics-cjpeb/' .$book->id . '.' . $file->extension();
                move_uploaded_file($file->getRealPath(), $pathC);

                $book->img_cover = $pathC;
            }
            // else {
            //     return back()->withInput()->withErrors(['img_cover'=>'Field belum semua terisi.']);
            // }

            $book->save();
            
            // dd($book);
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
