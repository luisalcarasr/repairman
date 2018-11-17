<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaintenanceTypeRequest as Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MaintenanceType;

class MaintenanceTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasPermissionTo('read maintenance types')) {
            return view('maintenance-type.index')->with('maintenance_types', MaintenanceType::withTrashed()->get());
        } else {
            flash(trans("permission.read.maintenance-type"))->error()->important();
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
        if (Auth::user()->hasPermissionTo('write maintenance types')) {
            return view('maintenance-type.create');
        } else {
            flash(trans("permission.write.maintenance-type"))->error()->important();
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
        MaintenanceType::create($request->all());
        flash(trans("messages.success.maintenance-type.store"))->success()->important();
        return redirect()->route('maintenance-type.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->hasPermissionTo('read maintenance types')) {
            return view('maintenance-type.show')->with('maintenance_type', MaintenanceType::find($id));
        } else {
            flash(trans("permission.read.maintenance-type"))->error()->important();
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
        if (Auth::user()->hasPermissionTo('write maintenance types')) {
            return view('maintenance-type.edit')->with('maintenance_type', MaintenanceType::find($id));
        } else {
            flash(trans("permission.write.maintenance-type"))->error()->important();
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
        MaintenanceType::find($id)->fill($request->all())->save();
        flash(trans("messages.success.maintenance-type.update"))->success()->important();
        return redirect()->route('maintenance-type.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->hasPermissionTo('delete maintenance types')) {
            $maintenance_type = MaintenanceType::withTrashed()->find($id);
            if($maintenance_type->trashed()) {
                $maintenance_type->restore();
                flash(trans("messages.success.maintenance-type.restore"))->info()->important();
            } else {
                $maintenance_type->delete();
                flash(trans("messages.success.maintenance-type.delete"))->warning()->important();
            }
            return redirect()->back();
        } else {
            flash(trans("permission.delete.maintenance-type"))->error()->important();
            return back();
        }
    }
}
