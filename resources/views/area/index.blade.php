@extends('layouts.main')
@section('title', 'Area')
@section('button')
<a href="{{ route('area.create') }}" class="btn btn-info pull-right m-l-20">
    <i class="fa fa-plus text-white"></i>
</a>
@endsection
@section('breadcrumb')
    <li class="active"><a href="{{ route('area.index') }}">Areas</a></li>
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
                                <th>Name</th>
                                <th>Description</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Deleted at</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($areas as $area)
                            <tr>
                                <td>{{ $area->id }}</td>
                                <td>{{ $area->name }}</td>
                                <td>{{ $area->description }}</td>
                                <td>{{ $area->created_at }}</td>
                                <td>{{ $area->updated_at }}</td>
                                <td>{{ $area->deleted_at }}</td>
                                <td>
                                    <a class="btn btn-warning" href="{{ route('area.edit', $area->id) }}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a class="btn btn-primary" href="{{ route('area.show', $area->id) }}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('delete-form-{{$area->id}}').submit();">
                                        <i class="fa fa-{{ $area->trashed() ? 'un' : '' }}lock"></i>
                                    </a>
                                    <form id="delete-form-{{$area->id}}" action="{{ route('area.destroy', $area->id) }}" method="POST" style="display: none;">
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