@extends('layouts.main')
@section('title', 'Create an new maintenance type')
@section('button')
<button class="btn btn-info pull-right m-l-20" onclick="$('form').submit()">
    <i class="fa fa-save text-white"></i>
</button>
@endsection
@section('breadcrumb')
    <li class="active"><a href="{{ route('maintenance-type.index') }}">Maintenance types</a></li>
    <li class="active"><a href="{{ route('maintenance-type.create') }}">Create</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-offset-4 col-sm-4">
            <div class="white-box">
                <form class="form-horizontal" method="POST" action="{{ route('maintenance-type.store') }}">
                    @csrf
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label class="col-md-12" for="name">Name</label>
                        <div class="col-md-12">
                            <input type="text" id="name" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}">
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
                            <input type="text" id="description" name="description" class="form-control" placeholder="Description" value="{{ old('description') }}">
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