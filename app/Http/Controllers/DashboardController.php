<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('dashboard.show', Carbon::now()->toDateString());
    }

    /**
     * Display the specified resource.
     *
     * @param $date
     * @return \Illuminate\Http\Response
     */
    public function show($date)
    {
        return view('dashboard')->with('maintenances', Maintenance::where('programmed_to', $date)->get())
            ->with('all_maintenances', Maintenance::all());
    }
}
