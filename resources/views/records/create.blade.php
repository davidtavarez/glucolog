@extends('layouts.master') @section('content')
<div class="block">
    <div class="block-header block-header-default">
        <h3 class="block-title">Registrar Medida

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
        <form action="/" method="post" onsubmit="return false;">
            <div class="row">
                <div class="form-group col-sm-4">
                    <label for="date">Fecha</label>
                    <input type="date" class="form-control" name="date">
                </div>
                <div class="form-group col-sm-2">
                        <label for="date">Toma</label>
                        <input type="number" name="measure" class="form-control">
                    </div>
                <div class="form-group col-sm-3">
                    <label>¿Está en ayuno?</label>
                    <br>
                    <div class="custom-control custom-checkbox custom-control-inline mb-5">
                        <input class="custom-control-input" type="checkbox" name="example-inline-checkbox1" id="example-inline-checkbox1" value="option1"
                            checked>
                        <label class="custom-control-label" for="example-inline-checkbox1">Si</label>
                    </div>
                    <div class="custom-control custom-checkbox custom-control-inline mb-5">
                        <input class="custom-control-input" type="checkbox" name="example-inline-checkbox2" id="example-inline-checkbox2" value="option2">
                        <label class="custom-control-label" for="example-inline-checkbox2">No</label>
                    </div>
                </div>
                <div class="form-group col-sm-4">
                        <label for="date">¿Que comió?</label>
                        <textarea name="comment" cols="20" rows="2" class="form-control"></textarea>
                    </div>
                    
                <div class="form-group col-sm-4">
                    <label for="date">Comentario</label>
                    <textarea name="comment" cols="20" rows="2" class="form-control"></textarea>
                </div>
                
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-alt-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection