@extends('layouts.master') @section('content')
<div class="block">
    <div class="block-header block-header-default">
        <h3 class="block-title">Registrar Nivel de Glicemia
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
        <form action="/records" method="post">
            {{csrf_field()}}
            <div class="row">
                <div class="form-group row col-sm-12">
                    <div class="col-sm-4">
                        <label for="date">Fecha</label>
                        <input type="date" class="form-control" name="date" required>
                    </div>
                    <div class="col-sm-4">
                        <label for="time">Hora</label>
                        <input type="time" class="form-control" name="time" required>
                    </div>
                    <div class="col-sm-2">
                        <label for="date">Nivel</label>
                        <input type="number" name="measure" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row col-sm-12">
                    <div class="col-sm-10">
                        <label>Condición:</label>
                        <br>
                        <label class="css-control css-control-primary css-radio">
                            <input class="css-control-input" name="condition" value="1" type="radio" checked required>
                            <span class="css-control-indicator"></span> Ayuno
                        </label>

                        <label class="css-control css-control-primary css-radio">
                            <input class="css-control-input" name="condition" value="2" type="radio" required>
                            <span class="css-control-indicator"></span> Post-comida
                        </label>
                    </div>
                </div>
                <div class="form-group row col-sm-12">
                    <div class="col-sm-4">
                        <label for="comment">Comentario</label>
                        <textarea name="comment" cols="50" rows="2" class="form-control"></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-alt-primary">Guardar</button>
            </div>
        </form>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>
@endsection
