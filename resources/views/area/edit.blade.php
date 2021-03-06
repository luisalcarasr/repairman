@extends('layouts.main')
@section('title', 'Editar un area')
@section('button')
<button class="btn btn-info pull-right m-l-20" onclick="$('form').submit()">
    <i class="fa fa-edit text-white"></i>
</button>
@endsection
@section('breadcrumb')
    <li class="active"><a href="{{ route('area.index') }}">Areas</a></li>
    <li class="active"><a href="{{ route('area.edit', $area->id) }}">Edit</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-offset-4 col-sm-4">
            <div class="white-box">
                <form class="form-horizontal" method="POST" action="{{ route('area.update', $area->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label class="col-md-12" for="name">Nombre</label>
                        <div class="col-md-12">
                            <input type="text" id="name" name="name" class="form-control" placeholder="Nombre" value="{{ $errors->has('name') ? old('name') : $area->name }}">
                            @if ($errors->has('name'))
                                <span class="help-block with-errors">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                        <label class="col-md-12" for="description">Descripción</label>
                        <div class="col-md-12">
                            <input type="text" id="description" name="description" class="form-control" placeholder="Descripción" value="{{ $errors->has('description') ? old('description') : $area->description }}">
                            @if ($errors->has('description'))
                                <span class="help-block with-errors">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection