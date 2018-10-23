@extends('layouts.master') @section('content')

<h2 class="content-heading">Niveles de glicemia</h2>
<div class="row gutters-tiny">
@foreach($records as $record)
<div class="col-6 col-md-4 col-xl-2">
    <a class="block block-rounded block-bordered block-link-pop text-center" href="{{ $record->path() }}">
        <div class="block-content">
            <p class="mt-5 text-pulse">
            <i class="si si-drop fa-2x text-pulse"></i>
            <br>
                <strong>{{ $record->measure }}</strong>
            </p>
            <p class="font-w300">{{ $record->status }} <br> {{ $record->created_at->diffForHumans() }}</p>
        </div>
    </a>
</div>
@endforeach
</div>

{{ $records->links() }}
@endsection