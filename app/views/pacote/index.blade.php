@extends('templates.home')
@section('title')
<div class="page-title-container">
    <div class="container">
        <div class="page-title pull-left">
            <h2 class="entry-title">{{trans('menu.pacotes')}}</h2>
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
                        <!-- <h4 class="panel-title">
                            <a data-toggle="collapse" href="#price-filter" class="collapsed">Price</a>
                        </h4>
                        <div id="price-filter" class="panel-collapse collapse">
                            <div class="panel-content">
                                <div id="price-range"></div>
                                <br />
                                <span class="min-price-label pull-left"></span>
                                <span class="max-price-label pull-right"></span>
                                <div class="clearer"></div>
                            </div>
                        </div> -->
                    </div>

                    <div class="panel style1 arrow-right">
                       <!--  <h4 class="panel-title">
                            <a data-toggle="collapse" href="#rating-filter" class="collapsed">User Rating</a>
                        </h4>
                        <div id="rating-filter" class="panel-collapse collapse filters-container">
                            <div class="panel-content">
                                <div id="rating" class="five-stars-container editable-rating"></div>
                                <br />
                                <small>2458 REVIEWS</small>
                            </div>
                        </div> -->
                    </div>

                    <!-- <div class="panel style1 arrow-right">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" href="#accomodation-type-filter" class="collapsed">Accomodation Type</a>
                        </h4>
                        <div id="accomodation-type-filter" class="panel-collapse collapse">
                            <div class="panel-content">
                                <ul class="check-square filters-option">
                                    <li><a href="#">All<small>(722)</small></a></li>
                                    <li><a href="#">Hotel<small>(982)</small></a></li>
                                    <li><a href="#">Resort<small>(127)</small></a></li>
                                    <li class="active"><a href="#">Bed &amp; Breakfast<small>(222)</small></a></li>
                                    <li><a href="#">Condo<small>(158)</small></a></li>
                                    <li><a href="#">Residence<small>(439)</small></a></li>
                                    <li><a href="#">Guest House<small>(52)</small></a></li>
                                </ul>
                                <a class="button btn-mini">MORE</a>
                            </div>
                        </div>
                    </div>

                    <div class="panel style1 arrow-right">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" href="#amenities-filter" class="collapsed">Amenities</a>
                        </h4>
                        <div id="amenities-filter" class="panel-collapse collapse">
                            <div class="panel-content">
                                <ul class="check-square filters-option">
                                    <li><a href="#">Bathroom<small>(722)</small></a></li>
                                    <li><a href="#">Cable tv<small>(982)</small></a></li>
                                    <li class="active"><a href="#">air conditioning<small>(127)</small></a></li>
                                    <li class="active"><a href="#">mini bar<small>(222)</small></a></li>
                                    <li><a href="#">wi - fi<small>(158)</small></a></li>
                                    <li><a href="#">pets allowed<small>(439)</small></a></li>
                                    <li><a href="#">room service<small>(52)</small></a></li>
                                </ul>
                                <a class="button btn-mini">MORE</a>
                            </div>
                        </div>
                    </div>

                    <div class="panel style1 arrow-right">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" href="#language-filter" class="collapsed">Host Language</a>
                        </h4>
                        <div id="language-filter" class="panel-collapse collapse">
                            <div class="panel-content">
                                <ul class="check-square filters-option">
                                    <li><a href="#">English<small>(722)</small></a></li>
                                    <li><a href="#">Español<small>(982)</small></a></li>
                                    <li class="active"><a href="#">Português<small>(127)</small></a></li>
                                    <li class="active"><a href="#">Français<small>(222)</small></a></li>
                                    <li><a href="#">Suomi<small>(158)</small></a></li>
                                    <li><a href="#">Italiano<small>(439)</small></a></li>
                                    <li><a href="#">Sign Language<small>(52)</small></a></li>
                                </ul>
                                <a class="button btn-mini">MORE</a>
                            </div>
                        </div>
                    </div> -->

                    <div class="panel style1 arrow-right">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" href="#modify-search-panel" class="collapsed">{{trans('hotel.modificar_busca')}}</a>
                        </h4>
                        <div id="modify-search-panel" class="panel-collapse collapse">
                            <div class="panel-content">
                                <form method="get" action="{{URL::to('pacote/')}}">
                                    <div class="form-group">
                                        <label>{{trans('hotel.destino')}}</label>
                                        <input name="continente" type="text" class="input-text full-width destino" placeholder="Ex: Brazil" value="" />
                                    </div>
                                    <!-- <div class="form-group">
                                        <label>check in</label>
                                        <div class="datepicker-wrap">
                                            <input type="text" class="input-text full-width" placeholder="mm/dd/yy" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>check out</label>
                                        <div class="datepicker-wrap">
                                            <input type="text" class="input-text full-width" placeholder="mm/dd/yy" />
                                        </div>
                                    </div> -->
                                    <br />
                                    <button class="btn-medium icon-check uppercase full-width">search again</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-8 col-md-9">
                <!-- <div class="sort-by-section clearfix">
                    <h4 class="sort-by-title block-sm">Sort results by:</h4>
                    <ul class="sort-bar clearfix block-sm">
                        <li class="sort-by-name"><a class="sort-by-container" href="#"><span>name</span></a></li>
                        <li class="sort-by-price"><a class="sort-by-container" href="#"><span>price</span></a></li>
                        <li class="clearer visible-sms"></li>
                        <li class="sort-by-rating active"><a class="sort-by-container" href="#"><span>rating</span></a></li>
                        <li class="sort-by-popularity"><a class="sort-by-container" href="#"><span>popularity</span></a></li>
                    </ul>

                    <ul class="swap-tiles clearfix block-sm">
                        <li class="swap-list active">
                            <a href="hotel-list-view.html"><i class="soap-icon-list"></i></a>
                        </li>
                        <li class="swap-grid">
                            <a href="hotel-grid-view.html"><i class="soap-icon-grid"></i></a>
                        </li>
                        <li class="swap-block">
                            <a href="hotel-block-view.html"><i class="soap-icon-block"></i></a>
                        </li>
                    </ul>
                </div> -->
                <div class="hotel-list listing-style3 hotel">
                @if($pacotes)

                    @foreach($pacotes as $pacote)
                        <article class="box">
                            <figure class="col-sm-5 col-md-4">
                                <a title="" href="{{URL::to("pacote/show/{$pacote->id}")}}" class="hover-effect"><img width="270" height="160" alt="" src="@if(isset($pacote->imagem)) uploads/pacotes/270x160_{{$pacote->imagem}} @else http://placehold.it/270x160 @endif"></a>
                            </figure>
                            <div class="details col-sm-7 col-md-8">
                                <div>
                                    <div>
                                        <h4 class="box-title"><a href="{{URL::to("pacote/show/{$pacote->id}")}}"> @if(Session::get('lang') == 'pt') {{$pacote->nome_br}} @else {{$pacote->nome_en}} @endif </a><small><i class="soap-icon-departure yellow-color"></i> {{$pacote->pais->name}} - {{$pacote->estado}} </small></h4>

                                    </div>
                                    <div>
                                        <div title="" class="five-stars-container" data-toggle="tooltip" data-placement="bottom" data-original-title="{{$pacote->estrelas or 0}} Estrelas">
                                                <span class="five-stars" style="width: {{$pacote->estrelas * 20}}%;"></span>
                                        </div>
                                        <span class="review">{{$pacote->estrelas or 0}} {{trans('hotel.estrelas')}}</span>
                                    </div>
                                </div>
                                <div>
                                    <p>@if(Session::get('lang') == 'pt') {{substr(strip_tags($pacote->descricao_br), 0, 150) . ' ...'}} @else {{substr(strip_tags($pacote->descricao_en), 0, 150) . ' ...'}} @endif</p>
                                    <div>
                                        <span class="price"><small>{{trans('hotel.preco_noite')}}</small>{{$pacote->valor}}</span>
                                        <a class="button btn-small full-width text-center" title="" href="{{URL::to("pacote/show/{$pacote->id}")}}">{{trans('hotel.selecionar')}}</a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                    </div>
                    <!--a href="#" class="uppercase full-width button btn-large">load more listing</a-->
                    {{$pacotes->appends(Input::except('page'))->links()}}
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