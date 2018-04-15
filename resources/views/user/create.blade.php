@extends('layouts.main')
@section('title', 'Create an new user')
@section('button')
<button class="btn btn-info pull-right m-l-20" onclick="$('form').submit()">
    <i class="fa fa-save text-white"></i>
</button>
@endsection
@section('breadcrumb')
    <li class="active"><a href="{{ route('user.index') }}">Users</a></li>
    <li class="active"><a href="{{ route('user.create') }}">Create</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-offset-4 col-sm-4">
            <div class="white-box">
                <form class="form-horizontal" method="POST" action="{{ route('user.store') }}">
                    @csrf
                    <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                        <label class="col-md-12" for="first_name">First name</label>
                        <div class="col-md-12">
                            <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First name" value="{{ old('first_name') }}">
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
                            <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last name" value="{{ old('last_name') }}">
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
                            <input type="email" id="email" name="email" class="form-control" placeholder="username@email.com" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="help-block with-errors">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('role_id') ? 'has-error' : '' }}">
                        <label class="col-md-12" for="_id">Role</label>
                        <div class="col-md-12">
                            <select id="role_id" name="role_id" class="form-control" placeholder="Role" value="{{ old('role_id') }}">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id || $role->name == 'supervisor' ? 'selected' : '' }}>{{ __('roles.'.$role->name) }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('role_id'))
                                <span class="help-block with-errors">
                                    <strong>{{ $errors->first('role_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label class="col-md-12" for="password">Password</label>
                        <div class="col-md-12">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Password" value="{{ old('password') }}">
                            @if ($errors->has('password'))
                                <span class="help-block with-errors">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                        <label class="col-md-12" for="password_confirmation">Password confirmation</label>
                        <div class="col-md-12">
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Password confirmation" value="{{ old('password_confirmation') }}">
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block with-errors">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection