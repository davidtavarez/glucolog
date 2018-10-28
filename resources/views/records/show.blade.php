@extends('layouts.master') @section('content')

<div class="block">
    <div class="block-header block-header-default">
        <h3 class="block-title">
            Detalles
        </h3>
        <div class="block-options">
            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="pinned_toggle">
                <i class="si si-pin"></i>
            </button>
            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
        </div>
    </div>
    <div class="block-content">
        <div class="row">
            <div class="col-sm-4">
                <label>Fecha:</label>
                <p>{{$record->date}}</p>
            </div>
            <div class="col-sm-2">
                <label>Toma:</label>
                <p>{{$record->measure}} mg/dL</p>
            </div>
            <div class="col-sm-3">
                <label>¿Estaba en ayuno?:</label>
                @if($record->is_in_fast === True)
                <p>Si</p>
                @else
                <p>No</p>
                @endif
            </div>
            <div class="col-sm-4">
                <label>Comentario:</label>
                <p>{{$record->comment}}</p>
            </div>
        </div>
    </div>
</div>


@endsection