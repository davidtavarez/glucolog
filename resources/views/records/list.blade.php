@extends('layouts.master') @section('content')

    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">
                Historial de medidas
            </h3>
        </div>
        <div class="block-content">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Nivel</th>
                    <th>Condicion</th>
                    <th>Estado</th>
                </tr>
                </thead>
                <tbody>
                @foreach($records as $measure)
                    <tr>
                        <td>
                            {{$measure->fcreated()}}
                        </td>
                        <td>
                            {{$measure->measure}}
                        </td>
                        <td>
                            {{$measure->condition}}
                        </td>
                        <td>
                            {{$measure->status}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection