@extends('layouts.master') @section('content')

<div class="block">
    <div class="block-header block-header-default">
        <h3 class="block-title">
            Historial
        </h3>
        <div class="block-options">
            <a href="/records/create" class="btn btn-sm btn-primary">Registrar Glicemia</a>
            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="pinned_toggle">
                <i class="si si-pin"></i>
            </button>
            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
        </div>
    </div>
    <div class="block-content">
        <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>¿Que comió?</th>
                    <th>Glicemia</th>
                    <th>Usuario</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $record)
                <tr>
                    <td>
                        <a href="{{$record->path()}}">{{$record->fcreated()}}</a>
                    </td>
                    <td>
                        @if($record->food === null) Estaba en ayuno @else {{$record->food}} - {{$record->food_type}} @endif
                    </td>
                    <td>
                        @if($record->measure > 180 || $record->measure
                        < 70 ) <span class="badge badge-danger">
                            {{$record->measure}}
                            </span>
                            @else
                            <span class="badge badge-success">
                                {{$record->measure}}
                            </span>
                            @endif
                    </td>
                    <td>{{$record->user->name}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection