<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Http\Requests\MaintenanceRequest as Request;
use App\Models\Machine;
use App\Models\Maintenance;
use App\Models\MaintenanceType;
use Illuminate\Support\Facades\Auth;

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
            return view('maintenance.index')->with('maintenances', Maintenance::withTrashed()->get());
        } else {
            flash(trans("permission.read.maintenance"))->error()->important();
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
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new Maintenance($request->all());
        $user->status = "pending";
        $user->started_at = $request->programmed_to;
        $user->repeat_each = $request->repeat_each ? $request->repeat_each : 0;
        $user->save();
        flash(trans("messages.success.maintenance.store"))->success()->important();
        return redirect()->route('maintenance.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->hasPermissionTo('read maintenances')) {
            return view('maintenance.index')->with('maintenances', Maintenance::withTrashed());
        } else {
            flash(trans("permission.read.maintenance"))->error()->important();
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
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Maintenance::find($id)->fill($request->all())->save();
        flash(trans("messages.success.maintenance.update"))->success()->important();
        return redirect()->route('maintenance.index');
    }


    /**
     * Complete the maintenance.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function complete(Request $request, $id)
    {
        $maintenance = Maintenance::find($id);
        $maintenance->status = 'completed';
        $maintenance->save();
        $maintenance->delete();

        $new = new Maintenance($maintenance->toArray());
        $new->programmed_to = $maintenance->started_at->addMonths($new->repeat_each);
        $new->started_at = $new->programmed_to;
        $new->status = 'pending';
        $new->save();


        flash(trans("messages.success.maintenance.update"))->success()->important();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->hasPermissionTo('delete maintenances')) {
            $maintenance = Maintenance::withTrashed()->find($id);
            if ($maintenance->trashed()) {
                $maintenance->restore();
                $maintenance->status = 'restored';
                flash(trans("messages.success.maintenance.restore"))->info()->important();
            } else {
                $maintenance->delete();
                $maintenance->status = 'locked';
                flash(trans("messages.success.maintenance.delete"))->warning()->important();
            }
            $maintenance->save();
            return redirect()->back();
        } else {
            flash(trans("permission.delete.maintenance"))->error()->important();
            return back();
        }
    }
}
