<?php

namespace App\Http\Controllers;

use App\Models\Jumbotron;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JumbotronController extends Controller
{
    public function index()
    {
        
        $jumbotrons = Jumbotron::get();

        return view('admin.jumbotrons.index', [
            'jumbotrons' => $jumbotrons,
        ]);
    }

    protected function imgvalidator(array $data)
    {
        return Validator::make($data, [
            'img_slide' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);
    }

    public function edit($id)
    {
        $jumbotron = Jumbotron::find($id);
        return view('admin.jumbotrons.edit', [
            'jumbotron' => $jumbotron,
        ]);
    }

    public function update(Request $request)
    {
        try {
            $jumbotron = Jumbotron::find($request->id);

            if ($request->file('img_slide')) { 
                $imgvalidator = $this->imgvalidator([$request->file('img_slide')]);
                if ($imgvalidator->fails()) {
                    return redirect()->back()
                        ->withErrors($imgvalidator)
                        ->withInput();
                }
    
                if(!is_null($jumbotron->img_slide) && file_exists(str_replace('\\', '/', public_path()) . '/' . 'images/jumbotrons/' . $jumbotron->img_slide)) {
                    unlink(str_replace('\\', '/', public_path()) . '/' . 'images/jumbotrons/' . $jumbotron->img_slide);
                }

                $file = $request->file('img_slide');
                $fileName = strtolower(str_replace(' ', '_', str_replace(' & ', '_', $jumbotron->id))) . '.' . $file->extension();
                $path = public_path() . '/' . 'images/jumbotrons/' . $fileName;
                move_uploaded_file($file->getRealPath(), str_replace('\\', '/', $path));
                $jumbotron->img_slide = $fileName;
            }

            $jumbotron->save();
        } catch (QueryException $ex) { 
            dd($ex->errorInfo[1]);
        }  

        return redirect('/admin/jumbotrons/');
    }
}
