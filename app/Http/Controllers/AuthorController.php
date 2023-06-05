<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AuthorController extends Controller
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
        
        $authors = Author::leftJoin('books_authors', 'authors.id', '=', 'books_authors.author_id')
                ->leftJoin('books', 'books_authors.book_id', '=', 'books.id')
                ->select('authors.*', DB::raw('count(books.id) as book_count'))
                ->where(function ($query) use ($request) {
                    if (($key = $request->key)) {
                        $query->orWhere('authors.name', 'LIKE', '%' . $key . '%');
                    }
                })
                ->groupBy('authors.id')
                ->orderBy('authors.name', 'asc')
                ->paginate(20);
        return view('admin.authors.index', [
            'authors' => $authors,
        ]);
     //
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
            $request->validate([
                'name' => ['required', 'string', 'max:150', Rule::unique('authors')],
            ]);
            $author = new Author();
            $author->name = $request->name;
            $author->save();

            return redirect('/admin/authors/');
        } catch (QueryException $ex) { 
            dd($ex->errorInfo[1]); 
            return back()->withErrors(['error' => 'An error occurred while saving the author.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $author = Author::find($id);
        return view('admin.authors.edit', [
            'author' => $author,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, Author $author)
    {
        try {
            $author = Author::find($request->id);
            $request->validate([
                'name' => ['required', 'string', 'max:255', Rule::unique('authors')],
            ]);
            $author->name = $request->name;
            $author->save();
            return redirect('/admin/authors/');
        } catch (QueryException $ex) { 
            dd($ex->errorInfo[1]); 
            return back()->withErrors(['error' => 'An error occurred while saving the author.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
