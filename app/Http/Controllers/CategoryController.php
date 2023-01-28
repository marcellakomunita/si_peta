<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        
        $categories = Category::where([
            [function ($query) use ($request) {
                if (($key = $request->key)) {
                    $query->orWhere('name', 'LIKE', '%' . $key . '%')
                        ->get();
                }
            }]
        ])->paginate(10);
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
    public function store(Request $request)
    {
        try {
            if ($request->img_icon) {
                $category = new Category();

                $category->name = $request->name;
                $category->img_icon = 'x';
                $category->save();
                
                
                $file = $request->file('img_icon');
                $path = public_path() . '\images\icon\\' . strtolower(str_replace(' ', '_', str_replace(' & ', '_', $category->name))) . '.' . $file->extension();
                move_uploaded_file($file->getRealPath(), $path);

                DB::table('categories')->where('id', $category->id)->update([
                    'img_icon' => $path
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
            $category->name = $request->name;

            if ($request->img_icon) {
                unlink($category->img_icon);
                $file = $request->file('img_icon');
                $path = public_path() . '/' . 'images/' . $category->id . '.' . $file->extension();
                move_uploaded_file($file->getRealPath(), $path);
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
        $category = Category::find($request->id);
        if (file_exists($category->img_icon)) {
            unlink($category->img_icon);
        }
        $category->delete();
        return redirect('/admin/categories');
    }
}
