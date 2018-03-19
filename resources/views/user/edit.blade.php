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
                <form class="form-horizontal" method="POST" action="{{ route('user.store') }}">
                    @csrf
                    <div class="form-group">
                        <label class="col-md-12" for="first_name">First name</label>
                        <div class="col-md-12">
                            <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First name" value="{{ $user->first_name }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="last_name">Last name</label>
                        <div class="col-md-12">
                            <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last name" value="{{ $user->last_name }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="email">Email</label>
                        <div class="col-md-12">
                            <input type="email" id="email" name="email" class="form-control" placeholder="username@email.com" value="{{ $user->email }}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection