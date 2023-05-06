<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookImage;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use PDOException;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

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

       $books = Book::where(function ($query) use ($request) {
            if (($key = $request->key)) {
                $query->orWhere('judul', 'LIKE', '%' . $key . '%')
                    ->orWhereHas('author', function ($authorQuery) use ($key) {
                        $authorQuery->where('name', 'LIKE', '%' . $key . '%');
                    });
            }
        })
        ->join('authors', 'books.penulis_id', '=', 'authors.id')
        ->join('publishers', 'books.penerbit_id', '=', 'publishers.id')
        ->select('books.*', 'authors.name as penulis', 'publishers.name as penerbit')
        ->orderBy('updated_at', 'desc')
        ->paginate(10);

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
        $categories = Category::select('id', 'name')->get();
        $authors = Author::select('id', 'name')->get();
        $publishers = Publisher::select('id', 'name')->get();
        return view('admin.books.create', compact('categories', 'authors', 'publishers'));
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
            'img_cover' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);
    }

    protected function pdfvalidator(array $data)
    {
        return Validator::make($data, [
            'file_ebook' => 'mimes:pdf'
        ]);
    }
    public function store(Request $request)
    {
        try {
            if ($request->file('file_ebook') && $request->file('img_cover')) {

                $request->validate([
                    'isbn' => ['required', 'string', 'min:10', 'max:13', Rule::unique('books')],
                    'judul' => ['required', 'string', 'max:255'],
                    'kategori' => ['required', 'string', 'min:3', 'max:4'],
                    'penulis' => ['required', 'string', 'max:3'],
                    'penerbit' => ['required', 'string', 'max:3'],
                    'sinopsis' => ['required', 'string', 'max:800'],
                    'tgl_terbit' => ['required']
                ]);

                $imgvalidator = $this->imgvalidator([$request->file('img_cover')]);
                if ($imgvalidator->fails()) {
                    return redirect()->back()
                        ->withErrors($imgvalidator)
                        ->withInput();
                }
                
                DB::beginTransaction();
                try {
                    $book = new Book();
                    $id = Str::random(16);
                    $book->id = $id;
                    $book->category_id = $request->kategori;
                    $book->isbn = $request->isbn;
                    $book->judul = $request->judul;
                    $book->penulis_id = $request->penulis;
                    $book->penerbit_id = $request->penerbit;
                    $book->sinopsis = $request->sinopsis;
                    $book->tgl_terbit = $request->tgl_terbit;
                    $book->file_ebook = 'x';
                    $book->img_cover = 'x';
                    $book->save();

                    $book2 = Book::find($book->id);

                    $file = $request->file('img_cover');
                    $imgvalidator = $this->imgvalidator($request->file());
                    if ($imgvalidator->fails()) {
                        return redirect()->back()
                            ->withErrors($imgvalidator)
                            ->withInput();
                    }
                    $pathC = $file->storeAs(
                        '',
                        $book->id . '.' . $file->extension(),
                        'cover'
                    );
                    $book2->img_cover = $pathC;

                    if (count($request->file('file_ebook')) == 1 && $request->file('file_ebook')[0]->getClientOriginalExtension() == 'pdf') {
                        $file = $request->file('file_ebook');

                        $pdfvalidator = $this->pdfvalidator([$file]);
                        if ($pdfvalidator->fails()) {
                            return redirect()->back()
                                ->withErrors($pdfvalidator)
                                ->withInput();
                        }

                        $pathB = $file[0]->storeAs(
                            '',
                            $book->id . '.' . $file[0]->extension(),
                            'books'
                        );
                        
                        $book2->file_ebook = $pathB;
                    }

                    else {
                        $files = $request->file('file_ebook');
                        
                        foreach ($files as $index => $file) {
                            $mimeType = $file->getMimeType();
                            if (!in_array($mimeType, ['image/jpeg', 'image/png', 'image/jpg'])) {
                                // Return an error response
                                return response()->json(['file_ebook' => 'Invalid file type']);
                            }

                            $pathB = $file->storeAs(
                                $book2->id,
                                $book2->id . '_' . $index . '.' . $file->extension(),
                                'books'
                            );
                            
                            $bookImage = new BookImage();
                            $bookImage->book_id = $book2->id;
                            $bookImage->image_path = $pathB;
                            $bookImage->save();

                        }
                    }

                    $book2->save();

                    DB::commit();
    
                    return redirect('admin/books/');
                } catch (PDOException $e) {
                    DB::rollBack();
                    dd($e);
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
        $categories = Category::select('id', 'name')->get();
        $authors = Author::select('id', 'name')->get();
        $publishers = Publisher::select('id', 'name')->get();
        return view('admin.books.edit', compact('book', 'categories', 'authors', 'publishers'));
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
        DB::beginTransaction();
        try {
            $book = Book::find($request->id);

            $request->validate([
                'isbn' => ['required', 'string', 'min:10', 'max:13', Rule::unique('books')->ignore($request->isbn, 'isbn')],
                'judul' => ['required', 'string', 'max:255'],
                'kategori' => ['required', 'string', 'min:3', 'max:4'],
                'penulis' => ['required', 'string', 'max:3'],
                'penerbit' => ['required', 'string', 'max:3'],
                'sinopsis' => ['required', 'string', 'max:800'],
                'tgl_terbit' => ['required']
            ]);
            
            $book->category_id = $request->kategori;
            $book->isbn = $request->isbn;
            $book->judul = $request->judul;
            $book->penulis_id = $request->penulis;
            $book->penerbit_id = $request->penerbit;
            $book->sinopsis = $request->sinopsis;
            $book->tgl_terbit = $request->tgl_terbit;

            if ($request->file('img_cover')) {
                $file = $request->file('img_cover');
                $imgvalidator = $this->imgvalidator($request->file());
                if ($imgvalidator->fails()) {
                    return redirect()->back()
                        ->withErrors($imgvalidator)
                        ->withInput();
                }

                $file_path = storage_path(env('COVER_DIR')) . $book->img_cover;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }

                $pathC = $file->storeAs(
                    '',
                    $book->id . '.' . $file->extension(),
                    'cover'
                );
                $book->img_cover = $pathC;
            }
            
            if ($request->file('file_ebook')) {
                // DELETING PREVIOUS
                if($book->file_ebook != 'x') {
                    $file_path = storage_path(env('EBOOKS_DIR')) . $book->file_ebook;
                    if (file_exists($file_path)) {
                        $files = glob($file_path . "/*"); 
                        array_map('unlink', $files);
                    }
                } else {
                    $files = BookImage::where('book_id', '=', $book->id)->get();
                    foreach ($files as $file) {
                        $file_path = storage_path(env('EBOOKS_DIR')) . $file->image_path;
                        if (file_exists($file_path)) {
                            unlink($file_path);
                        }
                    }
                    BookImage::where('book_id', '=', $book->id)->delete();
                }

                // INSERTING NEW ONES
                if (count($request->file('file_ebook')) == 1 && $request->file('file_ebook')[0]->getClientOriginalExtension() == 'pdf') {
                    $file = $request->file('file_ebook');

                    $pdfvalidator = $this->pdfvalidator([$file]);
                    if ($pdfvalidator->fails()) {
                        return redirect()->back()
                            ->withErrors($pdfvalidator)
                            ->withInput();
                    }

                    $pathB = $file[0]->storeAs(
                        '',
                        $book->id . '.' . $file[0]->extension(),
                        'books'
                    );
                    
                    $book->file_ebook = $pathB;
                } 
                else {

                    $files = $request->file('file_ebook');
                    foreach ($files as $index => $file) {
                        $mimeType = $file->getMimeType();
                        if (!in_array($mimeType, ['image/jpeg', 'image/png', 'image/jpg'])) {
                            return response()->json(['file_ebook' => 'Invalid file type']);
                        }

                        $pathB = $file->storeAs(
                            $book->id,
                            $book->id . '_' . $index . '.' . $file->extension(),
                            'books'
                        );
                        
                        $bookImage = new BookImage();
                        $bookImage->book_id = $book->id;
                        $bookImage->image_path = $pathB;
                        $bookImage->save();
                    }
                    $book->file_ebook = 'x';
                } 
            }

            $book->save();

            DB::commit();
        } catch (QueryException $ex) { 
            DB::rollBack();
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
        DB::beginTransaction();
        try {
            $book = Book::findOrFail($request->id);

            if($book->file_ebook == 'x') {
                $files = BookImage::where('book_id', '=', $book->id)->get();
                foreach ($files as $file) {
                    $file_path = storage_path(env('EBOOKS_DIR')) . $file->image_path;
                    if (file_exists($file_path)) {
                        unlink($file_path);
                    }

                    $folder_path = storage_path(env('EBOOKS_DIR')) . substr(strrchr($file->image_path, '/'), 0);
                    // rmdir($folder_path);
                    $file->delete();
                }
            } else {
                $file_path = storage_path(env('EBOOKS_DIR')) . $book->file_ebook;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }

            $file_path = storage_path(env('COVER_DIR')) . $book->img_cover;
            if (file_exists($file_path)) {
                unlink($file_path);
            }

            $book->delete();

            DB::commit();
        } catch (PDOException $e) {
            DB::rollBack();
            dd($e);
        }  

        return redirect('/admin/books');
    }

    public function print() 
    {
        $books = Book::get();
        $pdf = PDF::loadview('admin.books.print', compact('books'));
    	return $pdf->download('ebooks_' . date('Y-m-d') . '.pdf');
    }
}
