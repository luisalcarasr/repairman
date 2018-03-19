@extends('layouts.main')
@section('title', 'Create an new user')
@section('button')
<button class="btn btn-info pull-right m-l-20" onclick="$('form').submit()">
    <i class="fa fa-edit text-white"></i>
</button>
@endsection
@section('breadcrumb')
    <li class="active"><a href="{{ route('user.index') }}">Users</a></li>
    <li class="active"><a href="{{ route('user.edit', $user->id) }}">Edit</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-offset-4 col-sm-4">
            <div class="white-box">
                <form class="form-horizontal" method="POST" action="{{ route('user.update', $user->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                    <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                        <label class="col-md-12" for="first_name">First name</label>
                        <div class="col-md-12">
                            <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First name" value="{{ $errors->has('first_name') ? old('first_name') : $user->first_name }}">
                            @if ($errors->has('first_name'))
                                <span class="help-block with-errors">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                        <label class="col-md-12" for="last_name">Last name</label>
                        <div class="col-md-12">
                            <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last name" value="{{ $errors->has('last_name') ? old('last_name') : $user->last_name }}">
                            @if ($errors->has('last_name'))
                                <span class="help-block with-errors">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label class="col-md-12" for="email">Email</label>
                        <div class="col-md-12">
                            <input type="email" id="email" name="email" class="form-control" placeholder="username@email.com" value="{{ $errors->has('email') ? old('email') : $user->email }}">
                            @if ($errors->has('email'))
                                <span class="help-block with-errors">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection