@extends('templates.home')
@section('title')
<div class="page-title-container">
    <div class="container">
        <div class="page-title pull-left">
            <h2 class="entry-title">{{trans('menu.destinos')}}</h2>
        </div>
    </div>
</div>
@stop
@section('content')
<div class="container">
    <div id="main">
        <div class="row">
            <div class="col-sm-4 col-md-3">
                <h4 class="search-results-title"><i class="soap-icon-search"></i><b>{{$count}}</b> {{trans('hotel.resultados_encontrados')}}.</h4>
                <div class="toggle-container filters-container">
                    <div class="panel style1 arrow-right">
                    </div>

                    <div class="panel style1 arrow-right">
                    </div>                   

                    <div class="panel style1 arrow-right">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" href="#modify-search-panel" class="collapsed">{{trans('hotel.modificar_busca')}}</a>
                        </h4>
                        <div id="modify-search-panel" class="panel-collapse collapse">
                            <div class="panel-content">
                                <form method="get" action="{{URL::to('pacote/continentes')}}">
                                    <div class="form-group">
                                        <label>{{trans('formulario.continente')}}</label>
                                        <input name="continente" type="text" class="input-text full-width destino" placeholder="{{trans('formulario.busca_exemplo')}}" value="" />
                                    </div>
                                    <br />
                                    <button class="btn-medium icon-check uppercase full-width">{{trans('formulario.buscar')}}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-8 col-md-9">
                @if($continentes)
                	<div class="hotel-list">
                                <div class="row image-box listing-style2">
                                @foreach($continentes as $c)
                                    <div class="col-sms-6 col-sm-6 col-md-4">
                                        <article class="box">
                                            <figure>
                                                <a href="{{URL::to("pacote/paises/?continente={$c->name_pt}")}}" title="" class="hover-effect"><img src="{{$c->imagem or 'http://placehold.it/270x160'}}" alt="" width="270" height="160" /></a>
                                            </figure>
                                            <div class="details">
                                                <a title="View all" href="{{URL::to("pacote/paises/?continente={$c->name_pt}")}}" class="pull-right button uppercase">select</a>
                                                <h4 class="box-title">{{$c->name_en}} {{trans('pacotes.destinos')}}</h4>
                                            </div>
                                        </article>
                                    </div>
                                @endforeach
                                </div>
                            </div>
                @else
                    <article class="box">
                        <h2> Nenhum registro encontrado para esta busca</h2>
                    </article>
                @endif
            </div>
        </div>
    </div>
</div>
@stop


@section('scripts')
<script type="text/javascript">
    tjq(document).ready(function() {
        tjq("#price-range").slider({
            range: true,
            min: 0,
            max: 1000,
            values: [ 100, 800 ],
            slide: function( event, ui ) {
                tjq(".min-price-label").html( "$" + ui.values[ 0 ]);
                tjq(".max-price-label").html( "$" + ui.values[ 1 ]);
            }
        });
        tjq(".min-price-label").html( "$" + tjq("#price-range").slider( "values", 0 ));
        tjq(".max-price-label").html( "$" + tjq("#price-range").slider( "values", 1 ));

        tjq("#rating").slider({
            range: "min",
            value: 40,
            min: 0,
            max: 50,
            slide: function( event, ui ) {

            }
        });
    });
</script>


@section('scripts')

<script type="text/javascript">
  tjq(function() {
    var destinos = {{$json}}
    tjq( ".destino" ).autocomplete({
      source: destinos
    });
  });
</script>

@stop
@stop