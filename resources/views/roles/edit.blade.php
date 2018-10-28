@extends('layouts.master') 
@section('title', 'Editar Rol')
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
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fe fe-lock"></i> Editar Rol</h3>
                <div class="card-options">
                <form class="pull-right" action="/roles/{{$role->id}}" method="POST">
                {{ csrf_field() }} {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-danger btn-sm">Borrar
                    <i class="fe fe-x-square"></i>
                </button>
            </form></div>
        </div>

        <div class="card-body">
            <form action="/roles/{{$role->id}}" method="post">
                {{ csrf_field() }} {{ method_field('PUT') }}
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fe fe-clipboard"></i> Nombre</label>
                            <input type="text" name="name" class="form-control" placeholder="Nombre" value="{{$role->name}}">
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
                                    <option value="{{ $permission->id }}" @if($role->permissions->contains($permission->id)) selected @endif>{{ $permission->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @else
                    <h4>Todavia no hay ningun permiso creado.</h4>
                    @endif
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-outline-primary btn-sm">Guardar
                        <i class="fe fe-plus"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection