@extends('templates.admin')
@section('breadcrumbs')
<div class="page-title-container">
    <div class="container">
        <div class="page-title pull-left">
            <h2 class="entry-title">Eventos Especiais - Lista</h2>
        </div>
    </div>
</div>
@stop
@section('content')
	@include('elements.alerts')
	{{$filter}}
	{{$grid}}
@stop