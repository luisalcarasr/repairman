@extends('layouts.main')
@section('title', 'Editar un máquina')
@section('button')
<button class="btn btn-info pull-right m-l-20" onclick="$('form').submit()">
    <i class="fa fa-edit text-white"></i>
</button>
@endsection
@section('breadcrumb')
    <li class="active"><a href="{{ route('machine.index') }}">Máquinas</a></li>
    <li class="active"><a href="{{ route('machine.edit', $machine->id) }}">Edit</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-offset-4 col-sm-4">
            <div class="white-box">
                <form class="form-horizontal" method="POST" action="{{ route('machine.update', $machine->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                    <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                        <label class="col-md-12" for="description">Descripción</label>
                        <div class="col-md-12">
                            <input type="text" id="description" name="description" class="form-control" placeholder="Descripción" value="{{ $errors->has('description') ? old('description') : $machine->description }}">
                            @if ($errors->has('description'))
                                <span class="help-block with-errors">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('area_id') ? 'has-error' : '' }}">
                        <label class="col-md-12" for="area_id">Area</label>
                        <div class="col-md-12">
                            <select id="area_id" name="area_id" class="form-control" placeholder="Area" value="{{ old('area_id') }}">
                                @foreach($areas as $area)
                                    <option value="{{ $area->id }}" {{ old('area_id') == $area->id || $area->id == $machine->area_id ? 'selected' : '' }}>{{ $area->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('area_id'))
                                <span class="help-block with-errors">
                                    <strong>{{ $errors->first('area_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection