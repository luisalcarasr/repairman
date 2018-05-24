@extends('layouts.main')
@section('title', 'Editar un mantenimiento')
@section('button')
<button class="btn btn-info pull-right m-l-20" onclick="$('form').submit()">
    <i class="fa fa-edit text-white"></i>
</button>
@endsection
@section('breadcrumb')
    <li class="active"><a href="{{ route('maintenance.index') }}">Usuarios</a></li>
    <li class="active"><a href="{{ route('maintenance.edit', $maintenance->id) }}">Edit</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-offset-4 col-sm-4">
            <div class="white-box">
                <form class="form-horizontal" method="POST" action="{{ route('maintenance.update', $maintenance->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group {{ $errors->has('machine_id') ? 'has-error' : '' }}">
                        <label class="col-md-12" for="machine_id">Máquina</label>
                        <div class="col-md-12">
                            <select id="machine_id" name="machine_id" class="form-control" placeholder="Máquina" value="{{ $errors->has('machine_id') ? old('machine_id') : $maintenance->machine_id }}">
                                @foreach($machines as $machine)
                                    <option value="{{ $machine->id }}" {{ old('machine_id') == $machine->id || $machine->id == $maintenance->machine_id  ? 'selected' : '' }}>{{ $machine->description }}</option>
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
                        <label class="col-md-12" for="maintenance_type_id">Tipo de mantenimiento</label>
                        <div class="col-md-12">
                            <select id="maintenance_type_id" name="maintenance_type_id" class="form-control" placeholder="Tipo de mantenimiento" value="{{ $errors->has('maintenance_type_id') ? old('maintenance_type_id') : $maintenance->maintenance_type_id }}">
                                @foreach($maintenance_types as $maintenance_type)
                                    <option value="{{ $maintenance_type->id }}" {{ old('maintenance_type_id') == $maintenance_type->id || $maintenance_type->id == $maintenance->maintenance_type_id ? 'selected' : '' }}>{{ $maintenance_type->name }}</option>
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
                        <label class="col-md-12" for="description">Descripción</label>
                        <div class="col-md-12">
                            <input type="text" id="description" name="description" class="form-control" placeholder="Descripción" value="{{ $errors->has('description') ? old('description') : $maintenance->description }}">
                            @if ($errors->has('description'))
                                <span class="help-block with-errors">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('repeat_each') ? 'has-error' : '' }}">
                        <label class="col-md-12" for="repeat_each">Repeat each (Months)</label>
                        <div class="col-md-12">
                            <input type="number" max="12" min="0" id="repeat_each" name="repeat_each" class="form-control" placeholder="Months" value="{{ $errors->has('repeat_each') ? old('repeat_each') : $maintenance->repeat_each }}">
                            @if ($errors->has('repeat_each'))
                                <span class="help-block with-errors">
                                    <strong>{{ $errors->first('repeat_each') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('programmed_to') ? 'has-error' : '' }}">
                        <label class="col-md-12" for="programmed_to">Fecha</label>
                        <div class="col-md-12">
                            <input type="date" id="programmed_to" name="programmed_to" class="form-control" value="{{ $errors->has('programmed_to') ? old('programmed_to') : $maintenance->programmed_to->format('Y-m-d') }}">
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