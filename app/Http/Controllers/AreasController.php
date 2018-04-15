<?php

namespace App\Http\Controllers;

use App\Http\Requests\AreaRequest as Request;
use Illuminate\Support\Facades\Auth;
use App\Area;

class AreasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasPermissionTo('read areas')) {
            return view('area.index')->with('areas', Area::withTrashed()->get());
        } else {
            flash(trans("permission.read.area"))->error()->important();
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
        if (Auth::user()->hasPermissionTo('write areas')) {
            return view('area.create');
        } else {
            flash(trans("permission.write.area"))->error()->important();
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
        Area::create($request->all());
        return redirect()->route('area.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->hasPermissionTo('read areas')) {
            return view('area.show')->with('area', Area::find($id));
        } else {
            flash(trans("permission.read.area"))->error()->important();
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
        if (Auth::user()->hasPermissionTo('write areas')) {
            return view('area.edit')->with('area', Area::find($id));
        } else {
            flash(trans("permission.write.area"))->error()->important();
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
        Area::find($id)->fill($request->all())->save();
        return redirect()->route('area.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->hasPermissionTo('delete areas')) {
            $area = Area::withTrashed()->find($id);
            if($area->trashed())
                $area->restore();
            else
                $area->delete();
            return redirect()->back();
        } else {
            flash(trans("permission.delete.area"))->error()->important();
            return back();
        }
    }
}
