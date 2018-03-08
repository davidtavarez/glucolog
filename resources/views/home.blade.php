@extends('layouts.master') 
@section('content')
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Niveles de hoy
                <small>{{date('d/m/Y')}}</small>
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
            @foreach($records as $record)
             @if($record->medida > 180 || $record->medida < 70)
             <div class="col-md-10">
                <div class="alert alert-danger" role="alert">
                    <h3 class="alert-heading font-size-h4 font-w400">{{$record->created_at}}</h3>
                    <p class="mb-0"><b>Comida:</b> @if($record->comida === null)
                        Estaba en ayuno 
                        @else 
                        {{$record->comida}}
                        @endif <b>Medida: </b><span class="alert-heading font-size-h4 font-w300">{{$record->medida}}</span></p>
                </div>
            </div>
            @else
            <div class="col-md-10">
                <div class="alert alert-success" role="alert">
                    <h3 class="alert-heading font-size-h4 font-w400">{{$record->created_at}}</h3>
                    <p class="mb-0"><b>Comida:</b> @if($record->comida === null)
                        Estaba en ayuno 
                        @else 
                        {{$record->comida}}
                        @endif <b>Medida: </b><span class="alert-heading font-size-h4 font-w300">{{$record->medida}}</span></p>
                </div>
            </div>
            @endif 
        @endforeach
    </div>

@endsection