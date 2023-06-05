<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PublisherController extends Controller
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
        
        $publishers = Publisher::leftJoin('books', 'publishers.id', '=', 'books.penerbit_id')
                    ->select('publishers.*', DB::raw('count(books.penerbit_id) as book_count'))
                    ->where(function ($query) use ($request) {
                        if (($key = $request->key)) {
                            $query->orWhere('publishers.name', 'LIKE', '%' . $key . '%');
                        }
                    })
                    ->groupBy('publishers.id')
                    ->orderBy('publishers.name', 'asc')
                    ->paginate(20);
        return view('admin.publishers.index', [
            'publishers' => $publishers,
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
                'name' => ['required', 'string', 'max:150', Rule::unique('publishers')],
            ]);
            $publisher = new Publisher();
            $publisher->name = $request->name;
            $publisher->save();

            return redirect('/admin/publishers/');
        } catch (QueryException $ex) { 
            dd($ex->errorInfo[1]); 
            return back()->withErrors(['error' => 'An error occurred while saving the publisher.']);
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
        $publisher = Publisher::find($id);
        return view('admin.publishers.edit', [
            'publisher' => $publisher,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, Publisher $publisher)
    {
        try {
            $publisher = Publisher::find($request->id);
            $request->validate([
                'name' => ['required', 'string', 'max:255', Rule::unique('publishers')],
            ]);
            $publisher->name = $request->name;
            $publisher->save();
            return redirect('/admin/publishers/');
        } catch (QueryException $ex) { 
            dd($ex->errorInfo[1]); 
            return back()->withErrors(['error' => 'An error occurred while saving the publisher.']);
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
