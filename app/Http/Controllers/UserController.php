<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $users = User::where('type', '==', 0)->paginate(10);
        // // $users = User::get()->toQuery()->paginate(1);
        // return view('admin.users.index', [
        //     'users' => $users
        // ]);

        $users = User::where([
            ['type', '=', 0],
            [function ($query) use ($request) {
                if (($key = $request->key)) {
                    $query->orWhere('name', 'LIKE', '%' . $key . '%')
                        ->orWhere('email', 'LIKE', '%' . $key . '%')
                        ->get();
                }
            }]
        ])->paginate(10);
        return view('admin.users.index', [
            'users' => $users,
        ]);
    }

    public function indexAdmin(Request $request)
    {
        $administrators = User::where(
            function ($query) use ($request) {
                if ($key = $request->key) {
                    $query->orWhere('name', 'LIKE', '%' . $key . '%')
                        ->orWhere('email', 'LIKE', '%' . $key . '%')
                        ->get();
                }
            }
        )
        ->where('type', '=', 1)
        ->get();
        return view('admin.administrators.index', [
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
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->type = 0;
        $user->password = bcrypt($request->password);

        $user->save();
        return redirect('admin/users/');
    }

    public function storeAdmin(Request $request)
    {
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
            $administrator->name = $request->name;
            $administrator->email = $request->email;
            $administrator->phone = $request->phone;
            $administrator->save();
        } catch (Exception $e) {
            $message = $e->getMessage();
            var_dump('Exception Message: '. $message);
  
            $code = $e->getCode();       
            var_dump('Exception Code: '. $code);
  
            $string = $e->__toString();       
            var_dump('Exception String: '. $string);

            exit;
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
        $user = User::find($request->id);
        $user->delete();
        return redirect('/admin/users');
    }

    public function destroyAdmin(Request $request, User $administrator)
    {
        $administrator = User::find($request->id);
        $administrator->delete();
        return redirect('/admin/administrators');
    }
}
