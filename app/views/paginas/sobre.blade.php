@extends('templates.home')
@section('title')
<div class="page-title-container">
    <div class="container">
        <div class="page-title pull-left">
            <h2 class="entry-title">{{trans('paginas.sobre_nos')}}</h2>
        </div>
    </div>
</div>
@stop
@section('content')

<div class="container">
	<div class="image-style style1 large-block">

	    <h1 class="title">{{trans('paginas.sobre_nos')}}</h1>
	        {{$sobre}}
	    <div class="clearfix"></div>
	</div>
</div>

@stop