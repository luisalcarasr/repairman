<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaintenanceRequest as Request;
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
        return view('maintenance.index')->with('maintenances', Maintenance::withTrashed()->get()->sortBy('date'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('maintenance.create')->with('machines', Machine::all())->with('maintenance_types', MaintenanceType::all());
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
        return view('maintenance.show')->with('maintenance', Maintenace::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('maintenance.edit')->with('maintenance', Maintenance::find($id))->with('machines', Machine::all())->with('maintenance_types', MaintenanceType::all());;
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
        $maintenance = Maintenance::withTrashed()->find($id);
        if($maintenance->trashed())
            $maintenance->restore();
        else
            $maintenance->delete();
        return redirect()->back();
    }
}
