@extends('layouts.main')
@section('title', 'Create an new maintenance')
@section('button')
<button class="btn btn-info pull-right m-l-20" onclick="$('form').submit()">
    <i class="fa fa-save text-white"></i>
</button>
@endsection
@section('breadcrumb')
    <li class="active"><a href="{{ route('maintenance.index') }}">Users</a></li>
    <li class="active"><a href="{{ route('maintenance.create') }}">Create</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-offset-4 col-sm-4">
            <div class="white-box">
                <form class="form-horizontal" method="POST" action="{{ route('maintenance.store') }}">
                    @csrf
                    <div class="form-group {{ $errors->has('machine_id') ? 'has-error' : '' }}">
                        <label class="col-md-12" for="machine_id">Machine</label>
                        <div class="col-md-12">
                            <select id="machine_id" name="machine_id" class="form-control" placeholder="Machine" value="{{ old('machine_id') }}">
                                @foreach($machines as $machine)
                                    <option value="{{ $machine->id }}" {{ old('machine_id') == $machine->id ? 'selected' : '' }}>{{ $machine->description }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('machine_id'))
                                <span class="help-block with-errors">
                                    <strong>{{ $errors->first('machine_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('maintenance_type_id') ? 'has-error' : '' }}">
                        <label class="col-md-12" for="maintenance_type_id">Maintenance type</label>
                        <div class="col-md-12">
                            <select id="maintenance_type_id" name="maintenance_type_id" class="form-control" placeholder="Maintenance type" value="{{ old('maintenance_type_id') }}">
                                @foreach($maintenance_types as $maintenance_type)
                                    <option value="{{ $maintenance_type->id }}" {{ old('maintenance_type_id') == $maintenance_type->id ? 'selected' : '' }}>{{ $maintenance_type->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('maintenance_type_id'))
                                <span class="help-block with-errors">
                                    <strong>{{ $errors->first('maintenance_type_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                        <label class="col-md-12" for="description">Description</label>
                        <div class="col-md-12">
                            <input type="text" id="description" name="description" class="form-control" placeholder="Description" value="{{ old('description') }}">
                            @if ($errors->has('description'))
                                <span class="help-block with-errors">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('repeat_each') ? 'has-error' : '' }}">
                        <label class="col-md-12" for="repeat_each">Repeat each (months)</label>
                        <div class="col-md-12">
                            <input type="number" max="12" min="0" id="repeat_each" name="repeat_each" class="form-control" placeholder="Months" value="{{ old('repeat_each') }}">
                            @if ($errors->has('repeat_each'))
                                <span class="help-block with-errors">
                                    <strong>{{ $errors->first('repeat_each') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('programmed_to') ? 'has-error' : '' }}">
                        <label class="col-md-12" for="programmed_to">Programmed to</label>
                        <div class="col-md-12">
                            <input type="date" id="programmed_to" name="programmed_to" class="form-control" value="{{ old('programmed_to') }}">
                            @if ($errors->has('programmed_to'))
                                <span class="help-block with-errors">
                                    <strong>{{ $errors->first('programmed_to') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection