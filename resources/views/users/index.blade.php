@extends('layouts.master') 
@section('title', 'Usuarios') 
@section('content')
@include('flash::message')
<div class="col-4">
    <form action="/users/search" method="POST">
        {{ csrf_field() }}
        <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
                <input type="submit" class="btn btn-default-outline btn-sm soon" value="Buscar" id="inputGroup-sizing-sm">
            </div>
            <input name="content" id="inputSearch" type="text" class="form-control" aria-label="Sizing example input"
                aria-describedby="inputGroup-sizing-sm" autocomplete="off" placeholder="Nombre del usuario o email">
        </div>
    </form>
</div>

<div class="col-12">
    @if(Session::has('flash_message'))
    <p class="alert alert-{{ Session::get('class') }}">{{ Session::get('flash_message') }}</p>
    @endif
    <div class="card">
        <div class="card-status card-status-left bg-blue"></div>
        <div class="card-header">
            <h3 class="card-title">
                <i class="fe fe-user"></i> Usuarios</h3>
            <div class="card-options">
                <a href="/users/create" class="btn btn-outline-primary btn-sm">Crear usuario
                    <i class="fe fe-plus"></i>
                </a>
            </div>
        </div>
        <div class="card-body">
            <table id="list-user" class="table table-striped table-vcenter text-nowrap card-table">
                <thead>
                    <tr>
                        <th>
                            <i class="fe fe-clipboard"></i> Nombre</th>
                        <th>
                            <i class="fe fe-mail"></i> Correo</th>
                        <th>
                            <i class="fe fe-calendar"></i> Fecha de creacion</th>
                        <th>
                            <i class="fe fe-users"></i>Roles</th>
                        <th style="min-width: 150px;">
                            <i class="fe fe-refresh-ccw"></i> Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>
                            <a href="{{$user->path()}}/details">{{ $user->name }} {{ $user->lastname }}</a>
                        </td>
                        <td>{{ $user->email }}</td>

                        <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>
                        @if($user->roles())
                        <td>{{ $user->roles()->pluck('name')->implode(' ') }}</td>
                        @else
                        <td>Este usuario no tiene roles</td>
                        @endif
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-info btn-sm pull-left"
                                style="margin-right: 3px;">Editar
                                <i class="fe fe-user"></i>
                            </a>
                            @if(!$user->id === Auth::user()->id)
                            <form action="/users/{{$user->id}}" method="POST" onsubmit="return ConfirmDelete()">
                                {{ csrf_field() }} {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-outline-danger btn-sm pull-left">Borrar
                                    <i class="fe fe-x"></i>
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>
</div>

{{ $users->links() }}

@endsection
@section('scripts')
<script>
    function ConfirmDelete() {
        return confirm('Esta seguro que desea borrar este Usuario?');
    }

    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
@endsection