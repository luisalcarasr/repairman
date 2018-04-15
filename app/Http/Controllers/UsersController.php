<?php

namespace App\Http\Controllers;

Use App\Http\Requests\UserRequest as Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasPermissionTo('read users')) {
            return view('user.index')->with('users', User::withTrashed()->get());
        } else {
            flash(trans("permission.read.user"))->error()->important();
            return back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->hasPermissionTo('write users')) {
            return view('user.create');
        } else {
            flash(trans("permission.write.user"))->error()->important();
            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        User::create($request->all());
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->hasPermissionTo('read users')) {
            return view('user.show');
        } else {
            flash(trans("permission.read.user"))->error()->important();
            return back();
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
        if (Auth::user()->hasPermissionTo('write users')) {
            return view('user.edit')->with('user', User::find($id));
        } else {
            flash(trans("permission.write.user"))->error()->important();
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        User::find($id)->fill($request->all())->save();
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->hasPermissionTo('delete users')) {
            $user = User::withTrashed()->find($id);
            if($user->trashed())
                $user->restore();
            else
                $user->delete();
            return redirect()->back();
        } else {
            flash(trans("permission.delete.users"))->error()->important();
            return back();
        }
    }
}
