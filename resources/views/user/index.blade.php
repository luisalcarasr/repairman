@extends('layouts.main')
@section('title', 'Usuarios')
@section('button')
    <a href="{{ route('user.create') }}" class="btn btn-info pull-right m-l-20">
        <i class="fa fa-plus text-white"></i>
    </a>
@endsection
@section('breadcrumb')
    <li class="active"><a href="{{ route('user.index') }}">Usuarios</a></li>
@endsection
@section('content')
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">Usuarios</p>
            <a href="#" class="card-header-icon" aria-label="more options">
                <span class="icon">
                    <i class="fas fa-user-plus" aria-hidden="true"></i>
                </span>
            </a>
        </header>
        <div class="card-content">
            <div class="content is-paddingless">
                <users-table></users-table>
            </div>
        </div>
    </div>
@endsection