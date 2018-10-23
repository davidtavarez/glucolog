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
                    <div class="col-sm-2">
                        <label for="date">Glicemia</label>
                        <input type="number" name="measure" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row col-sm-12">
                    <div class="col-sm-10">
                        <label>Condición:</label>
                        <br>
                        <label class="css-control css-control-primary css-radio">
                            <input class="css-control-input" name="condition" value="1" type="radio" checked required>
                            <span class="css-control-indicator"></span> Basal y antes de las comidas
                        </label>

                        <label class="css-control css-control-primary css-radio">
                            <input class="css-control-input" name="condition" value="2" type="radio" required>
                            <span class="css-control-indicator"></span> 2 horas poscomida
                        </label>

                        <label class="css-control css-control-primary css-radio">
                            <input class="css-control-input" name="condition" value="3" type="radio" required>
                            <span class="css-control-indicator"></span> Antes de dormir
                        </label>

                        <label class="css-control css-control-primary css-radio">
                            <input class="css-control-input" name="condition" value="4" type="radio" required>
                            <span class="css-control-indicator"></span> De madrugada
                        </label>
                    </div>
                </div>
                <div class="form-group row col-sm-12">
                    <div class="col-sm-4">
                        <label for="date">Comentario</label>
                        <textarea name="comment" cols="20" rows="2" class="form-control"></textarea>
                    </div>
                    <div class="col-sm-4 food" style="display:none;">
                        <label for="date">¿Que comió?</label>
                        <textarea name="food" cols="20" rows="2" class="form-control"></textarea>
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

@section('scripts')
<script>
$('input[type="radio"]').click(function () {
    if ($(this).attr("value") !== "2") {
        $(".food").hide('slow');
    }
    if ($(this).attr("value") == "2") {
        $(".food").show('slow');
    }
});

</script>
@endsection