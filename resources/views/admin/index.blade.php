@extends('layouts.master') @section('content')

<div class="block">
    <div class="block-header block-header-default">
        <h3 class="block-title">
            Usuarios
        </h3>
        <div class="block-options">
            <a href="/admin/create" class="btn btn-sm btn-primary">Crear Usuario</a>
            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="pinned_toggle">
                <i class="si si-pin"></i>
            </button>
            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
        </div>
    </div>
    <div class="block-content">
        <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Is Admin</th>
                    <th>Is User</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>
                       <a href="{{$user->path()}}">{{$user->name}}</a> 
                    </td>
                    <td>
                        {{$user->email}}
                    </td>
                    <td>{{$user->is_admin}}</td>
                    <td>{{$user->is_user}}</td>
                    <td class="text-center">
                        <form action="/admin/{{$user->id}}" method="POST" onsubmit="return ConfirmDelete()">
                            {{ csrf_field() }} {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-sm btn-secondary"><i class="fa fa-close"></i></button>
                         </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<script>
        function ConfirmDelete() {
            return confirm('Esta seguro que desea borrar este usuario?');
        }
    </script>

@endsection