<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest as Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

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
            return view('user.create')->with('roles', Role::all());
        } else {
            flash(trans("permission.write.user"))->error()->important();
            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create($request->all());
        $user->assignRole(Role::find($request->role_id)->name);
        flash(trans("messages.success.user.store"))->success()->important();
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->hasPermissionTo('write users')) {
            return view('user.edit')->with('user', User::find($id))->with('roles', Role::all());
        } else {
            flash(trans("permission.write.user"))->error()->important();
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id)->fill($request->all());
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        if (User::role('admin')->get()->count() == 1 && User::role('admin')->get()->first()->id == $user->id)
            flash(trans("messages.last_admin"))->error()->important();
        else
            $user->syncRoles([Role::find($request->role_id)->name]);
        flash(trans("messages.success.user.update"))->success()->important();
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->hasPermissionTo('delete users')) {
            $user = User::withTrashed()->find($id);

            if (User::role('admin')->get()->count() == 1 && User::role('admin')->get()->first()->id == $user->id) {
                flash(trans("messages.last_admin"))->error()->important();
                return back();
            } else {
                if ($user->trashed()) {
                    $user->restore();
                    flash(trans("messages.success.user.restore"))->info()->important();
                } else {
                    $user->delete();
                    flash(trans("messages.success.user.delete"))->warning()->important();
                }
                return redirect()->back();
            }
        } else {
            flash(trans("permission.delete.user"))->error()->important();
            return back();
        }
    }
}
