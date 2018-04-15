<?php

namespace App\Http\Controllers;

use App\Http\Requests\MachineRequest as Request;
use Illuminate\Support\Facades\Auth;
use App\Machine;
use App\Area;

class MachinesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasPermissionTo('read machines')) {
            return view('machine.index')->with('machines', Machine::withTrashed()->get());
        } else {
            flash(trans("permission.read.machine"))->error()->important();
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
        if (Auth::user()->hasPermissionTo('write machines')) {
            return view('machine.create')->with('areas', Area::all());
        } else {
            flash(trans("permission.write.machine"))->error()->important();
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
        Machine::create($request->all());
        flash(trans("messages.success.machine.store"))->success()->important();
        return redirect()->route('machine.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->hasPermissionTo('read machines')) {
            return view('machine.show')->with('machine', Machine::find($id));
        } else {
            flash(trans("permission.read.machine"))->error()->important();
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
        if (Auth::user()->hasPermissionTo('write machines')) {
            return view('machine.edit')->with('machine', Machine::find($id))->with('areas', Area::all());
        } else {
            flash(trans("permission.write.machine"))->error()->important();
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
        Machine::find($id)->fill($request->all())->save();
        flash(trans("messages.success.machine.update"))->success()->important();
        return redirect()->route('machine.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->hasPermissionTo('delete machines')) {
            $machine = Machine::withTrashed()->find($id);
            if($machine->trashed()) {
                $machine->restore();
                flash(trans("messages.success.machine.restore"))->info()->important();
            } else {
                $machine->delete();
                flash(trans("messages.success.machine.delete"))->warning()->important();
            }
            return redirect()->back();
        } else {
            flash(trans("permission.delete.machine"))->error()->important();
            return back();
        }
    }
}
