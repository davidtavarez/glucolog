@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Niveles de hoy</div>

                <div class="card-body">
                    <div class="alert alert-success font-weight-bold" role="alert">
                    {{date("Y-m-d h:i:s")}} - Despues de desayunar
                    <h3 class="float-right">103</h3>
                    </div>
                    <div class="alert alert-success font-weight-bold" role="alert">
                    {{date("Y-m-d h:i:s")}} - Despues de comer
                    <h3 class="float-right">103</h3>
                    </div>
                    <div class="alert alert-warning font-weight-bold" role="alert">
                    {{date("Y-m-d h:i:s")}} - Antes de cenar
                    <h3 class="float-right">103</h3>
                    </div>
                    <div class="alert alert-danger font-weight-bold" role="alert">
                    {{date("Y-m-d h:i:s")}} - Despues de cenar
                    <h3 class="float-right">150</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
