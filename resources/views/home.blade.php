@extends('layouts.master') @section('content')
<div class="block">
    <div class="block-header block-header-default">
        <h3 class="block-title">Blank
            <small>Get Started</small>
        </h3>
        <div class="block-options">
            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="pinned_toggle">
                <i class="si si-pin"></i>
            </button>
            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                <i class="si si-refresh"></i>
            </button>
            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="close">
                <i class="si si-close"></i>
            </button>
        </div>
    </div>
    <div class="block-content">
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
@endsection