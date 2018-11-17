<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Http\Requests\FileRequest as Request;
use App\Models\File;
use Illuminate\Support\Facades\Auth;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasPermissionTo('read files')) {
            return view('file.index')->with('files', File::all());
        } else {
            flash(trans("permission.read.file"))->error()->important();
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
        if (Auth::user()->hasPermissionTo('write files')) {
            return view('file.create');
        } else {
            flash(trans("permission.write.file"))->error()->important();
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
        $file = new File();
        $file->fill($request->all());
        $path = $request->doc->store('public');
        $file->file = $path;
        $file->save();
        flash(trans("messages.success.file.store"))->success()->important();
        return redirect()->route('file.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->hasPermissionTo('read files')) {
            return redirect()->to('/' . explode('/', File::find($id)->file)[1]);
        } else {
            flash(trans("permission.read.file"))->error()->important();
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
        if (Auth::user()->hasPermissionTo('write files')) {
            return view('file.edit')->with('file', File::find($id))->with('areas', Area::all());
        } else {
            flash(trans("permission.write.file"))->error()->important();
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
        File::find($id)->fill($request->all())->save();
        flash(trans("messages.success.file.update"))->success()->important();
        return redirect()->route('file.index');
    }
}
