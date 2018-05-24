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
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <div class="table-responsive">
                    <table class="table table-striped table-improved">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre(s)</th>
                                <th>Apellido(s)</th>
                                <th>Rol</th>
                                <th>Email</th>
                                <th>Fecha de creación</th>
                                <th>Fecha de actualización</th>
                                <th>Fecha de eliminación</th>
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
                                    <a class="btn btn-warning" href="{{ route('user.edit', $user->id) }}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <!--<a class="btn btn-primary">
                                        <i class="fa fa-eye"></i>
                                    </a>-->
                                    @if($user->id != Auth::id())
                                    <a class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('delete-form-{{$user->id}}').submit();">
                                        <i class="fa fa-{{ $user->trashed() ? 'un' : '' }}lock"></i>
                                    </a>
                                    <form id="delete-form-{{$user->id}}" action="{{ route('user.destroy', $user->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection