<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
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
        
        $categories = Category::leftJoin('books', 'categories.id', '=', 'books.category_id')
                    ->select('categories.*', DB::raw('count(books.category_id) as book_count'))
                    ->where(function ($query) use ($request) {
                        if (($key = $request->key)) {
                            $query->orWhere('categories.name', 'LIKE', '%' . $key . '%');
                        }
                    })
                    ->groupBy('categories.id')
                    ->orderBy('categories.updated_at', 'desc')
                    ->paginate(20);

        return view('admin.categories.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
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
            'img_icon' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);
    }
    public function store(Request $request)
    {
        try {
            if ($request->file('img_icon')) {

                $request->validate([
                    'name' => ['required', 'string', 'max:255', Rule::unique('categories')],
                ]);

                $imgvalidator = $this->imgvalidator([$request->file('img_icon')]);
                if ($imgvalidator->fails()) {
                    return redirect()->back()
                        ->withErrors($imgvalidator)
                        ->withInput();
                }

                $category = new Category();

                $category->name = $request->name;
                $category->img_icon = 'x';
                $category->save();
                
                
                $file = $request->file('img_icon');
                $fileName = strtolower(str_replace(' ', '_', str_replace(' & ', '_', $category->name))) . '.' . $file->extension();
                $path = public_path() . '/' . 'images/icon/' . $fileName;
                move_uploaded_file($file->getRealPath(), str_replace('\\', '/', $path));

                DB::table('categories')->where('id', $category->id)->update([
                    'img_icon' => $fileName
                ]);

                return redirect('admin/categories/');
            }
            
        } catch (QueryException $ex) {
            if ($ex->errorInfo[1] == 2300) {
                return back()->withInput()->withErrors(['error'=>'Penyimpanan gagal, mohon ulang sesaat lagi.']);
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
        $category = Category::find($id);
        return view('admin.categories.edit', [
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        try {
            $category = Category::find($request->id);

            $request->validate([
                'name' => ['required', 'string', 'max:255', Rule::unique('categories')->ignore($request->name, 'name')]],
            );

            $category->name = $request->name;

            if ($request->file('img_icon')) { 
                $imgvalidator = $this->imgvalidator([$request->file('img_icon')]);
                if ($imgvalidator->fails()) {
                    return redirect()->back()
                        ->withErrors($imgvalidator)
                        ->withInput();
                }
    
                if(!is_null($category->img_icon) && file_exists(str_replace('\\', '/', public_path()) . '/' . 'images/icon/' . $category->img_icon)) {
                    unlink(str_replace('\\', '/', public_path()) . '/' . 'images/icon/' . $category->img_icon);
                }

                $file = $request->file('img_icon');
                $fileName = strtolower(str_replace(' ', '_', str_replace(' & ', '_', $category->name))) . '.' . $file->extension();
                $path = public_path() . '/' . 'images/icon/' . $fileName;
                move_uploaded_file($file->getRealPath(), str_replace('\\', '/', $path));
                $category->img_icon = $fileName;
            }

            $category->save();
        } catch (QueryException $ex) { 
            dd($ex->errorInfo[1]);
        }  

        return redirect('/admin/categories/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Category $category)
    {
        $category = Category::findOrFail($request->id);
        if (file_exists($category->img_icon)) {
            unlink($category->img_icon);
        }
        $category->delete();
        return redirect('/admin/categories');
    }
}
