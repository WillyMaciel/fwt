@extends('templates.admin')
@section('breadcrumbs')
<div class="page-title-container">
    <div class="container">
        <div class="page-title pull-left">
            <h2 class="entry-title">Mailing - Lista</h2>
        </div>
    </div>
</div>
@stop
@section('content')
	@include('elements.alerts')
	{{$filter}}

	<br />

	<form method="POST" action="{{URL::to('admin/mailing/csv')}}">
		<button type="submit" class="btn-success"> Gerar CSV </button>
	</form>
	{{$grid}}
@stop