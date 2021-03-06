@extends('layouts.main')
@section('title', 'Tipo de mantenimientos')
@section('button')
<a href="{{ route('maintenance-type.create') }}" class="btn btn-info pull-right m-l-20">
    <i class="fa fa-plus text-white"></i>
</a>
@endsection
@section('breadcrumb')
    <li class="active"><a href="{{ route('maintenance-type.index') }}">Tipo de mantenimientos</a></li>
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
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Fecha de creación</th>
                                <th>Fecha de actualización</th>
                                <th>Fecha de eliminación</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($maintenance_types as $maintenance_type)
                            <tr>
                                <td>{{ $maintenance_type->id }}</td>
                                <td>{{ $maintenance_type->name }}</td>
                                <td>{{ $maintenance_type->description}}</td>
                                <td>{{ $maintenance_type->created_at }}</td>
                                <td>{{ $maintenance_type->updated_at }}</td>
                                <td>{{ $maintenance_type->deleted_at }}</td>
                                <td>
                                    <a class="btn btn-warning" href="{{ route('maintenance-type.edit', $maintenance_type->id) }}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a class="btn btn-primary" href="{{ route('maintenance-type.show', $maintenance_type->id) }}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('delete-form-{{$maintenance_type->id}}').submit();">
                                        <i class="fa fa-{{ $maintenance_type->trashed() ? 'un' : '' }}lock"></i>
                                    </a>
                                    <form id="delete-form-{{$maintenance_type->id}}" action="{{ route('maintenance-type.destroy', $maintenance_type->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
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