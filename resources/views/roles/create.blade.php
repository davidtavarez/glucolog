@extends('layouts.master') @section('title', 'Crear Rol') @section('content')
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
    <form class="card" action="{{ route('roles.store') }}" method="post">
        <div class="card-status card-status-left bg-blue"></div>
        {{ csrf_field() }}
        <div class="card-body">
            <h3 class="card-title">
                <i class="fe fe-lock"></i> Nuevo Rol</h3>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fe fe-clipboard"></i> Nombre</label>
                        <input type="text" name="name" class="form-control" placeholder="Nombre">
                    </div>
                </div>
                @if(!$permissions->isEmpty())
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <div class="form-label">
                            <i class="fe fe-arrow-down-right"></i> Permisos</div>
                        <div class="custom-controls-stacked">
                            <select name="permissions[]" id="permissions" class="form-control form-control-chosen" data-placeholder="Por favor seleccione..."
                                multiple>
                                @foreach ($permissions as $permission)
                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                @else
                <h4>Todavia no hay ningun permiso creado.</h4>
                @endif
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-outline-primary btn-sm">Crear Rol
                <i class="fe fe-plus"></i>
            </button>
        </div>
    </form>
</div>