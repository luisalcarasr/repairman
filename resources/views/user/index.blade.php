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
                <table class="table is-marginless">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre(s)</th>
                        <th>Apellido(s)</th>
                        <th>Rol</th>
                        <th>Email</th>
                        <th>Creación</th>
                        <th>Actualización</th>
                        <th>Eliminación</th>
                        <th>Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ __('roles.'.$user->roles->first()->name) }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->updated_at }}</td>
                            <td>{{ $user->deleted_at }}</td>
                            <td>
                                <div class="field has-addons">

                                <div class="control">
                                    <a class="button" href="{{ route('user.edit', $user->id) }}">
                                        <span class="icon is-small">
                                            <i class="fas fa-pencil"></i>
                                        </span>
                                    </a>
                                </div>
                                <div class="control">
                                    <a class="button">
                                        <span class="icon is-small">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </a>
                                </div>
                                @if($user->id != Auth::id())
                                    <div class="control">
                                        <a class="button"
                                           onclick="event.preventDefault(); document.getElementById('delete-form-{{$user->id}}').submit();">
                                            <i class="fa fa-{{ $user->trashed() ? 'un' : '' }}lock"></i>
                                        </a>
                                        <form id="delete-form-{{$user->id}}" action="{{ route('user.destroy', $user->id) }}"
                                              method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection