@extends('layouts.main')
@section('title', 'Máquinas')
@section('button')
<a href="{{ route('machine.create') }}" class="btn btn-info pull-right m-l-20">
    <i class="fa fa-plus text-white"></i>
</a>
@endsection
@section('breadcrumb')
    <li class="active"><a href="{{ route('machine.index') }}">Máquinas</a></li>
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
                                <th>Descripción</th>
                                <th>Area</th>
                                <th>Fecha de creación</th>
                                <th>Fecha de actualización</th>
                                <th>Fecha de eliminación</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($machines as $machine)
                            <tr>
                                <td>{{ $machine->id }}</td>
                                <td>{{ $machine->description }}</td>
                                <td>{{ $machine->area ? $machine->area->name : 'Unavaible' }}</td>
                                <td>{{ $machine->created_at }}</td>
                                <td>{{ $machine->updated_at }}</td>
                                <td>{{ $machine->deleted_at }}</td>
                                <td>
                                    <a class="btn btn-warning" href="{{ route('machine.edit', $machine->id) }}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a class="btn btn-primary" href="{{ route('machine.show', $machine->id) }}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('delete-form-{{$machine->id}}').submit();">
                                        <i class="fa fa-{{ $machine->trashed() ? 'un' : '' }}lock"></i>
                                    </a>
                                    <form id="delete-form-{{$machine->id}}" action="{{ route('machine.destroy', $machine->id) }}" method="POST" style="display: none;">
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