<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('id', Auth::id())->first();
        return view('user.profile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::user()->id)],
            'phone' => ['required', 'string', 'regex:/^(?:0)(?:\d{9,15})$/', Rule::unique('users')->ignore(Auth::user()->id)],
        ]);
    }

    protected function imgvalidator(array $data)
    {
        return Validator::make($data, [
            'user_photo' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);
    }
    
    public function update(Request $request)
    {
        try {

            $validator = $this->validator($request->all());

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            
            $user = User::where('id', Auth::id())->first();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;

            if($request->file('user_photo')) {
                $file = $request->file('user_photo');
                
                $imgvalidator = $this->imgvalidator([$file]);
                if ($imgvalidator->fails()) {
                    return redirect()->back()
                        ->withErrors($imgvalidator)
                        ->withInput();
                }

                if ($user->photo) {
                    $file_path = env('PROFILE_DIR') . $user->photo;
                    if (file_exists($file_path)) {
                        unlink($file_path);
                    }
                }

                $path = $file->storeAs(
                    '',
                    $user->id . '.' . $file->extension(),
                    'avatar'
                );
                
                $user->photo = $path;
            }
            $user->save();
            return redirect('/profile');
        } catch (QueryException $ex) { 
            dd($ex->errorInfo[1]);
        }  
    }
}
