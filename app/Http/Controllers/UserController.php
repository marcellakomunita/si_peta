<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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

    
        $users = User::where([
            ['type', '=', 0],
            [function ($query) use ($request) {
                if (($key = $request->key)) {
                    $query->orWhere('name', 'LIKE', '%' . $key . '%')
                        ->orWhere('email', 'LIKE', '%' . $key . '%')
                        ->get();
                }
            }]
        ])->orderBy('updated_at', 'desc')->paginate(10);
        return view('admin.users.index', [
            'users' => $users,
        ]);
    }

    public function indexAdmin(Request $request)
    {
        $request->validate([
            'key' => ['string', 'max:10']
        ]);

        $user = User::where('id', Auth::id())->first();

        $administrators = User::where([
            ['type', '=', 1],
            [function ($query) use ($request) {
                if (($key = $request->key)) {
                    $query->orWhere('name', 'LIKE', '%' . $key . '%')
                        ->orWhere('email', 'LIKE', '%' . $key . '%')
                        ->get();
                }
            }]
        ])->orderBy('updated_at', 'desc')->paginate(10);
        return view('admin.administrators.index', [
            'user' => $user,
            'administrators' => $administrators,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    public function createAdmin()
    {
        return view('admin.administrators.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'string', 'email', 'max:70', Rule::unique('users')],
            'phone' => ['required', 'string', 'regex:/^(?:0)(?:\d{9,15})$/', 'max:13', Rule::unique('users')],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

    public function store(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->type = 0;
        $user->password = Hash::make($request->password);

        $user->save();
        return redirect('admin/users/')->with('success', 'User berhasil ditambahkan');
    }

    public function storeAdmin(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $administrator = new User();
        $administrator->name = $request->name;
        $administrator->email = $request->email;
        $administrator->phone = $request->phone;
        $administrator->type = 1;
        $administrator->password = bcrypt($request->password);

        $administrator->save();
        return redirect('admin/administrators/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $user = User::find($id);
        // return view('admin.users.show', [
        //     'user' => $user,
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', [
            'user' => $user,
        ]);
    }

    public function editAdmin($id)
    {
        $administrator = User::find($id);
        return view('admin.administrators.edit', [
            'administrator' => $administrator,
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request, User $user)
    {
        try {
            $user = User::find($request->id);

            $request->validate([
                'name' => ['required', 'string', 'max:150'],
                'email' => ['required', 'string', 'email', 'max:70', Rule::unique('users')->ignore($request->email, 'email')],
                'phone' => ['required', 'string', 'regex:/^(?:0|62)[0-9]{9,15}$/', 'max:13', Rule::unique('users')->ignore($request->phone, 'phone')],
            ]);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->save();
        } catch (QueryException $ex) { 
            dd($ex->errorInfo[1]);
        }  

        return redirect('/admin/users/');
    }

    public function updateAdmin(Request $request, User $administrator)
    {
        try {
            $administrator = User::find($request->id);

            $request->validate([
                'name' => ['required', 'string', 'max:150'],
                'email' => ['required', 'string', 'email', 'max:70', Rule::unique('users')->ignore($request->email, 'email')],
                'phone' => ['required', 'string', 'regex:/^(?:0|62)[0-9]{9,15}$/', 'max:13', Rule::unique('users')->ignore($request->phone, 'phone')],
            ]);

            $administrator->name = $request->name;
            $administrator->email = $request->email;
            $administrator->phone = $request->phone;
            $administrator->save();
        } catch (QueryException $ex) { 
            dd($ex->errorInfo[1]);
        }  

        return redirect('/admin/administrators/');
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        $user = User::findOrFail($request->id);
        $user->delete();
        return redirect('/admin/users');
    }

    public function destroyAdmin(Request $request, User $administrator)
    {
        $administrator = User::findOrFail($request->id);
        $administrator->delete();
        return redirect('/admin/administrators');
    }

    public function printUser() 
    {
        $users = User::where('type', 0)->get();
        $pdf = PDF::loadview('admin.users.print', compact('users'));
    	return $pdf->download('users_' . date('Y-m-d') . '.pdf');
    }

    public function printAdmin() 
    {
        $users = User::where('type', 1)->get();
        $pdf = PDF::loadview('admin.users.print', compact('users'));
    	return $pdf->download('administrators_' . date('Y-m-d') . '.pdf');
    }
}
