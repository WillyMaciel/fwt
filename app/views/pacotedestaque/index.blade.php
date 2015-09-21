@extends('templates.home')
@section('title')
<div class="page-title-container">
    <div class="container">
        <div class="page-title pull-left">
            <h2 class="entry-title">{{trans('menu.pacote_destaque')}}</h2>
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
                                <form method="get" action="{{URL::to('pacote-destaque/')}}">
                                    <div class="form-group">
                                        <label>{{trans('hotel.destino')}}</label>
                                        <input name="pais" type="text" class="input-text full-width destino" placeholder="Ex: Brazil" value="" />
                                    </div>
                                    <div class="form-group">
                                        <span id="div_pais_id">
                                            <label for="pais_id" class="">Tipo</label>
                                            {{Form::select('tipo', array('GayFriendly' => trans('menu.gay_friendly'), 'Bachelor' => trans('menu.despedida_solteiro'), 'Honeymoon' => trans('menu.lua_de_mel')), null, array('class' => 'form-control', 'id' => 'tipo'))}}
                                        </span>
                                    </div>
                                    <br />
                                    <button class="btn-medium icon-check uppercase full-width">search again</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-8 col-md-9">
                <div class="hotel-list listing-style3 hotel">
                @if($eventos)

                    @foreach($eventos as $evento)
                        <article class="box">
                            <figure class="col-sm-5 col-md-4">
                                <a title="" href="{{URL::to("pacote-destaque/show/{$evento->id}")}}" class="hover-effect"><img width="270" height="160" alt="" src="@if(isset($evento->imagem)) uploads/eventosespeciais/270x160_{{$evento->imagem}} @else http://placehold.it/270x160 @endif"></a>
                            </figure>
                            <div class="details col-sm-7 col-md-8">
                                <div>
                                    <div>
                                        <h4 class="box-title"><a href="{{URL::to("pacote-destaque/show/{$evento->id}")}}"> @if(Session::get('lang') == 'pt') {{$evento->nome_br}} @else {{$evento->nome_en}} @endif </a><small><i class="soap-icon-departure yellow-color"></i> {{$evento->pais->name}} - {{$evento->estado}} </small></h4>
                                    </div>
                                    <div>
                                        <!-- <div title="" class="five-stars-container" data-toggle="tooltip" data-placement="bottom" data-original-title="{{$evento->estrelas or 0}} Estrelas">
                                                <span class="five-stars" style="width: {{$evento->estrelas * 20}}%;"></span>
                                        </div>
                                        <span class="review">{{$evento->estrelas or 0}} {{trans('hotel.estrelas')}}</span> -->
                                    </div>
                                </div>
                                <div>
                                    <p>@if(Session::get('lang') == 'pt') {{substr($evento->descricao_br, 0, 150) . ' ...'}} @else {{substr($evento->descricao_en, 0, 150) . ' ...'}} @endif</p>
                                    <div>
                                        <span class="price"><small>{{trans('hotel.preco_noite')}}</small>{{ $evento->valor or '--' }}</span>
                                        <a class="button btn-small full-width text-center" title="" href="{{URL::to("pacote-destaque/show/{$evento->id}")}}">{{trans('hotel.selecionar')}}</a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                    </div>
                    {{$eventos->appends(Input::except('page'))->links()}}
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