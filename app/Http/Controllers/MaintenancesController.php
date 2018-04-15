<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaintenanceRequest as Request;
use Illuminate\Support\Facades\Auth;
use App\Maintenance;
use App\Machine;
use App\MaintenanceType;

class MaintenancesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasPermissionTo('read maintenances')) {
            return view('maintenance.index')->with('maintenances', Maintenance::withTrashed()->get()->sortBy('date'));
        } else {
            flash(trans("permission.read.maintenanace"))->error()->important();
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
        if (Auth::user()->hasPermissionTo('write maintenances')) {
            return view('maintenance.create')->with('machines', Machine::all())->with('maintenance_types', MaintenanceType::all());
        } else {
            flash(trans("permission.write.maintenance"))->error()->important();
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
        $user = new Maintenance($request->all());
        $user->status = "Pending";
        $user->repeat_each = $request->repeat_each ? $request->repeat_each : 0;
        $user->save();
        flash(trans("messages.success.maintenance.store"))->success()->important();
        return redirect()->route('maintenance.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->hasPermissionTo('read maintenances')) {
            return view('maintenance.show')->with('maintenance', Maintenace::find($id));
        } else {
            flash(trans("permission.read.maintenance"))->error()->important();
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
        if (Auth::user()->hasPermissionTo('write maintenances')) {
            return view('maintenance.edit')->with('maintenance', Maintenance::find($id))->with('machines', Machine::all())->with('maintenance_types', MaintenanceType::all());;
        } else {
            flash(trans("permission.write.maintenance"))->error()->important();
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
        Maintenance::find($id)->fill($request->all())->save();
        flash(trans("messages.success.maintenance.update"))->success()->important();
        return redirect()->route('maintenance.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->hasPermissionTo('delete maintenances')) {
            $maintenance = Maintenance::withTrashed()->find($id);
            if($maintenance->trashed()) {
                $maintenance->restore();
                flash(trans("messages.success.maintenance.restore"))->info()->important();
            } else {
                $maintenance->delete();
                flash(trans("messages.success.maintenance.delete"))->warning()->important();
            }
            return redirect()->back();
        } else {
            flash(trans("permission.delete.maintenance"))->error()->important();
            return back();
        }
    }
}
