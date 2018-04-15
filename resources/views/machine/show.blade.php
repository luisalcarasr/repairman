@extends('layouts.main')
@section('title', $machine->description)
@section('button')
<a href="{{ route('maintenance.create') }}" class="btn btn-info pull-right m-l-20">
    <i class="fa fa-plus text-white"></i>
</a>
@endsection
@section('breadcrumb')
    <li class="active"><a href="{{ route('maintenance.index') }}">Maintenances</a></li>
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
                                <th>Machine</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Maintenance</th>
                                <th>Programmed to</th>
                                <th>Deleted at</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($machine->maintenances as $maintenance)
                            <tr class="{{ $maintenance->deleted_at ? 'text-muted' : '' }}">
                                <td>{{ $maintenance->id }}</td>
                                <td>{{ $maintenance->machine->description }}</td>
                                <td>{{ $maintenance->description }}</td>
                                <td>{{ __( $maintenance->status) }}</td>
                                <td>{{ $maintenance->maintenance_type->name }}</td>
                                <td>{{ $maintenance->programmed_to->format('Y-m-d') }}</td>
                                <td>{{ $maintenance->deleted_at ? $maintenance->deleted_at->format('Y-m-d') : '' }}</td>
                                <td>
                                    <a class="btn btn-warning" href="{{ route('maintenance.edit', $maintenance->id) }}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('delete-form-{{$maintenance->id}}').submit();">
                                        <i class="fa fa-{{ $maintenance->trashed() ? 'un' : '' }}lock"></i>
                                    </a>
                                    <form id="delete-form-{{$maintenance->id}}" action="{{ route('maintenance.destroy', $maintenance->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    @if(Auth::user()->hasPermissionTo('write maintenances') && !$maintenance->trashed())
                                    <a class="btn btn-success" onclick="event.preventDefault(); document.getElementById('complete-form-{{$maintenance->id}}').submit();">
                                        <i class="fa fa-check"></i>
                                    </a>
                                    <form id="complete-form-{{$maintenance->id}}" action="{{ route('maintenance.complete', $maintenance->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('PUT')
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