<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    public function index()
    {
        
        $sliders = Slider::get();

        return view('admin.sliders.index', [
            'sliders' => $sliders,
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
        $slider = Slider::find($id);
        return view('admin.sliders.edit', [
            'slider' => $slider,
        ]);
    }

    public function update(Request $request)
    {
        try {
            $slider = Slider::find($request->id);
			
            if ($request->file('img_slide')) { 
                $imgvalidator = $this->imgvalidator($request->file());
                if ($imgvalidator->fails()) {
                    return redirect()->back()
                        ->withErrors($imgvalidator)
                        ->withInput();
                }
    
                if(!is_null($slider->img_slide) && file_exists(str_replace('\\', '/', public_path()) . '/' . 'images/sliders/' . $slider->img_slide)) {
                    unlink(str_replace('\\', '/', public_path()) . '/' . 'images/sliders/' . $slider->img_slide);
                }

                $file = $request->file('img_slide');
                $fileName = strtolower(str_replace(' ', '_', str_replace(' & ', '_', $slider->id))) . '.' . $file->extension();
                $path = public_path() . '/' . 'images/sliders/' . $fileName;
                move_uploaded_file($file->getRealPath(), str_replace('\\', '/', $path));
                $slider->img_slide = $fileName;
            }

            $slider->save();
        } catch (QueryException $ex) { 
            dd($ex->errorInfo[1]);
        }  

        return redirect('/admin/sliders/');
    }
}
