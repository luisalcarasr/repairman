@extends('layouts.main')
@section('title', 'Crear un nuevo file')
@section('button')
<button class="btn btn-info pull-right m-l-20" onclick="$('form').submit()">
    <i class="fa fa-save text-white"></i>
</button>
@endsection
@section('breadcrumb')
    <li class="active"><a href="{{ route('file.index') }}">Archivos</a></li>
    <li class="active"><a href="{{ route('file.create') }}">Crear</a></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-offset-4 col-sm-4">
            <div class="white-box">
                <form class="form-horizontal" method="POST" action="{{ route('file.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label class="col-md-12" for="name">Nombre</label>
                        <div class="col-md-12">
                            <input type="text" id="name" name="name" class="form-control" placeholder="Nombre" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <span class="help-block with-errors">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('file') ? 'has-error' : '' }}">
                        <label class="col-md-12" for="file">Archivo</label>
                        <div class="col-md-12">
                            <input type="file" if="file" name="doc" class="form-control-file" value="{{ old('file') }}"/>
                            @if ($errors->has('file'))
                                <span class="help-block with-errors">
                                    <strong>{{ $errors->first('file') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection