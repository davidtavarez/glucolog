@extends('layouts.master')
@section('title', 'Crear usuario')
@section('content')
<div class="col-12">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form class="card" action="{{ route('users.store') }}" method="post">
        <div class="card-status card-status-left bg-blue"></div>
        {{ csrf_field() }}
        <div class="card-body">
            <h3 class="card-title">
                <i class="fe fe-user"></i> Nuevo usuario</h3>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">
                            Nombres y apellido</label>
                        <input type="text" name="name" class="form-control" placeholder="Nombres y apellido" value="{{old('name')}}">
                    </div>
                </div>
                <div class="col-sm-3 col-md-3">
                    <div class="form-group">
                        <label class="form-label">
                            Email</label>
                        <input type="text" name="email" class="form-control" placeholder="Email" value="{{old('email')}}">
                    </div>
                </div>
                <div class="col-sm-3 col-md-3">
                    <div class="form-group">
                        <label class="form-label">
                            Fecha de nacimiento</label>
                        <input type="date" name="birthday" class="form-control" placeholder="birthday" value="{{old('birthday')}}">
                    </div>
                </div>
                <div class="col-sm-3 col-md-3">
                    <div class="form-group">
                        <label class="form-label">
                            Fecha de detección</label>
                        <input type="date" name="detection_date" class="form-control" placeholder="birthday" value="{{old('detection_date')}}">
                    </div>
                </div>
                
                <div class="col-sm-3 col-md-3">
                    <div class="form-group">
                        <label class="form-label">
                            Contraseña</label>
                        <input type="password" name="password" class="form-control" placeholder="Contraseña" value="{{old('password')}}">
                    </div>
                </div>

                <div class="col-sm-3 col-md-3">
                    <div class="form-group">
                        <label class="form-label">
                            Confirmar contraseña</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmar contraseña" value="{{old('password_confirmation')}}">
                    </div>
                </div>

                <div class="col-sm-3 col-md-3">
                    <div class="form-group">
                        <label class="form-label">
                            Tipo de diabetes</label>
                        <div class="col-md-6">
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-secondary">
                                    <input type="radio" name="diabetes" autocomplete="off" value="1"> {{
                                    __('auth.type_one') }}
                                </label>
                                <label class="btn btn-secondary">
                                    <input type="radio" name="diabetes" autocomplete="off" value="2"> {{
                                    __('auth.type_two') }}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <div class="form-label">
                            <i class="fe fe-lock"></i> Roles
                        </div>
                        <div class="custom-controls-stacked">
                            @foreach ($roles as $role)
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="roles[]" value="{{$role->id}}">
                                <span class="custom-control-label">{{ucfirst($role->name)}}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-outline-primary btn-sm">Crear Usuario
                <i class="fe fe-plus"></i>
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#insti').chosen({
            no_results_text: "No existe institucion de nombre "
        })
    })
</script>
@endsection