@extends('layouts.main')
@section('title', 'Dashboard')
@section('breadcrumb')
    <li class="active"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-8">
            <div class="white-box">
                <div class="table-responsive">
                    <table class="table table-striped table-improved">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Machine</th>
                                <th>Description</th>
                                <th>Maintenance</th>
                                <th>Programmed to</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($maintenances as $maintenance)
                            <tr class="{{ $maintenance->deleted_at ? 'text-muted' : '' }}">
                                <td>{{ $maintenance->id }}</td>
                                <td>{{ $maintenance->machine->description }}</td>
                                <td>{{ $maintenance->description }}</td>
                                <td>{{ $maintenance->maintenance_type->name }}</td>
                                <td>{{ $maintenance->programmed_to->format('Y-m-d') }}</td>
                                <td>
                                    <a class="btn btn-warning" href="{{ route('maintenance.edit', $maintenance->id) }}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <!--<a class="btn btn-primary">
                                        <i class="fa fa-eye"></i>
                                    </a>-->
                                    <a class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('delete-form-{{$maintenance->id}}').submit();">
                                        <i class="fa fa-{{ $maintenance->trashed() ? 'un' : '' }}lock"></i>
                                    </a>
                                    <form id="delete-form-{{$maintenance->id}}" action="{{ route('maintenance.destroy', $maintenance->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    @if(Auth::user()->hasPermissionTo('write maintenances') && $maintenance->status != 'completed')
                                    <a class="btn btn-success" onclick="event.preventDefault(); document.getElementById('complete-form-{{$maintenance->id}}').submit();">
                                        <i class="fa fa-check"></i>
                                    </a>
                                    @endif
                                    <form id="complete-form-{{$maintenance->id}}" action="{{ route('maintenance.complete', $maintenance->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('PUT')
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="white-box">
                <div id="maintenances"></div> 
            </div>
        </div>
    </div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $("#maintenances").zabuto_calendar({
            month: {{\Carbon\Carbon::createFromFormat('Y-m-d', Request::segment(2))->month}},
            year: {{\Carbon\Carbon::createFromFormat('Y-m-d', Request::segment(2))->year}},
            language: "en",
            today: true,
            action: function() {
                var date = $("#" + this.id).data("date");
                window.location.replace("/dashboard/" + date);
            },
            nav_icon: {
                prev: '<i class="fa fa-chevron-circle-left"></i>',
                next: '<i class="fa fa-chevron-circle-right"></i>'
            },
            cell_border: true,
            data: [
            {
                "date":"{{Request::segment(2)}}",
                "badge":true,
            },
            @foreach ($all_maintenances as $key => $maintenance)
            {
                "date":"{{$maintenance->programmed_to->format('Y-m-d')}}",
                "badge":false,
            },
            @endforeach
            ]
        });
    });
</script>
@endsection
