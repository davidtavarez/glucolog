@extends('layouts.master') @section('content')
<div class="block">
    <div class="block-header block-header-default">
        <h3 class="block-title">Crear usuario

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
        <form action="/admin" method="post">
            {{csrf_field()}}
            <div class="row">
                <div class="form-group col-sm-4">
                    <label for="date">Nombre</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="form-group col-sm-4">
                    <label for="date">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group col-sm-2">
                    <label>¿Es admin?</label>
                    <br>
                    <label class="css-control css-control-primary css-radio">
                        <input class="css-control-input" name="is_admin" value="1" type="radio">
                        <span class="css-control-indicator"></span> Si
                    </label>

                    <label class="css-control css-control-primary css-radio">
                        <input class="css-control-input" name="is_admin" value="0" type="radio">
                        <span class="css-control-indicator"></span> No
                    </label>
                </div>
                <div class="form-group col-sm-2">
                        <label>¿Es user?</label>
                        <br>
                        <label class="css-control css-control-primary css-radio">
                            <input class="css-control-input" name="is_user" value="1" type="radio">
                            <span class="css-control-indicator"></span> Si
                        </label>
    
                        <label class="css-control css-control-primary css-radio">
                            <input class="css-control-input" name="is_user" value="0" type="radio">
                            <span class="css-control-indicator"></span> No
                        </label>
                    </div>

                <div class="form-group col-sm-4">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group col-sm-4">
                        <label for="password_confirmation">Contraseña</label>
                        <input type="password" name="password_confirmation" class="form-control">
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