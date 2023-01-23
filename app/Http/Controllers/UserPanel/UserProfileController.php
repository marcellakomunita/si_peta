<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function update(Request $request)
    {
        try {
            $request->validate([
                'user_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            $user = User::where('id', Auth::id())->first();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;

            if($request->file('user_photo')) {
                if(!is_null($user->photo)) {
                    unlink($user->photo);
                }
                $file = $request->file('user_photo');
                $path = 'E:/hpics-upimg/' . $user->id . '.' . $file->extension();
                move_uploaded_file($file->getRealPath(), $path);

                $user->photo = $path;
            }
            $user->save();
            return redirect('/profile');
        } catch (QueryException $ex) { 
            dd($ex->errorInfo[1]);
        }  
    }
}
