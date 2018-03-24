@extends('layouts.main')
@section('title', 'Edit an maintenance type')
@section('button')
<button class="btn btn-info pull-right m-l-20" onclick="$('form').submit()">
    <i class="fa fa-edit text-white"></i>
</button>
@endsection
@section('breadcrumb')
    <li class="active"><a href="{{ route('maintenance-type.index') }}">Users</a></li>
    <li class="active"><a href="{{ route('maintenance-type.edit', $maintenance_type->id) }}">Edit</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-offset-4 col-sm-4">
            <div class="white-box">
                <form class="form-horizontal" method="POST" action="{{ route('maintenance-type.update', $maintenance_type->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label class="col-md-12" for="name">Name</label>
                        <div class="col-md-12">
                            <input type="text" id="name" name="name" class="form-control" placeholder="Name" value="{{ $errors->has('name') ? old('name') : $maintenance_type->name }}">
                            @if ($errors->has('name'))
                                <span class="help-block with-errors">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                        <label class="col-md-12" for="description">Description</label>
                        <div class="col-md-12">
                            <input type="text" id="description" name="description" class="form-control" placeholder="Description" value="{{ $errors->has('description') ? old('description') : $maintenance_type->description }}">
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