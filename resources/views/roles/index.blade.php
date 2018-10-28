@extends('layouts.master') @section('title', 'Roles') @section('content')
<div class="col-12">
@include('flash::message')
    <div class="card">
        <div class="card-status card-status-left bg-blue"></div>
        <div class="card-header">
            <h3 class="card-title">
                <i class="fe fe-lock"></i> Roles</h3>
            <div class="card-options">
                <a href="/roles/create" class="btn btn-outline-primary btn-sm">Crear Rol
                    <i class="fe fe-plus"></i>
                </a>
            </div>
        </div>
        <div class="card-body">
            <table id="list-roles" class="table table-striped">
                <thead>
                    <tr>
                        <th>
                            <i class="fe fe-clipboard"></i> Nombre</th>
                        <th>
                            <i class="fe fe-arrow-down-right"></i> Permisos</th>
                        <th>
                            <i class="fe fe-refresh-ccw"></i> Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>
                            @foreach($role->permissions as $permission)
                            <span class="badge badge-primary">{{$permission->name}}</span>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-outline-info btn-sm pull-left" style="margin-right: 3px;">Editar
                                <i class="fe fe-edit"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>
$('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
@endsection