@extends('templates.home')

@section('title')
<div class="page-title-container">
    <div class="container">
        <div class="page-title pull-left">
            <h2 class="entry-title">{{trans('menu.carrinho')}}</h2>
        </div>
    </div>
</div>
@stop

@section('content')
<section id="content" class="gray-area">
    <div class="container">
        <div id="main">
            @include('elements.alerts')                
                <div id="booking" class="tab-pane fade in active">
                    <h2>{{trans('carrinho.itens_pacote')}}</h2>

                    @if($carrinho)
                        <a href='{{URL::to("carrinho/limpar")}}'> <button class="btn-mini status"> {{trans('carrinho.limpar_carrinho')}} </button> </a>
                    @endif

                    <div class="booking-history">
                        @if($carrinho)
                            @foreach($carrinho as $produto)
                            <div class="booking-info clearfix">
                                <div class="date">
                                    <img src="{{URL::to('images/logo_icon.png')}}" class="img-responsive">
                                </div>
                                <h4 class="box-title"><i class="icon soap-icon-hotel blue-color circle"></i><a href="{{URL::to(strtolower($produto['produto']->class_name) . "/show/{$produto['produto']->id}")}}"> {{$produto['produto']->nome_br}} </a><small> {{trans('menu.'. str_replace(' ', '_', strtolower(trim(preg_replace('/(?<!\ )[A-Z]/', ' $0', $produto['produto']->class_name)))))}} @if ($produto['produto']->tipo) >> {{trans("menu.". strtolower($produto['produto']->tipo))}}  @endif</small></h4>
                                <dl class="info">
                                    <dt>{{trans('carrinho.preco')}}</dt>
                                    <dd>{{Session::get('moeda')->simbolo}} {{$produto['valor']}} {{--number_format($produto['valor'], 2, ",", ".")--}}</dd>
                                </dl>
                                <a href='{{URL::to("carrinho/remove/{$produto['produto']->id}")}}'> <button class="btn-mini status"> X {{trans('carrinho.remover')}} </button> </a>
                            </div>
                            @endforeach

                        @else

                            <div class="booking-info clearfix">
                                    <h2> Seu pacote esta vazio! </h2>
                            </div>

                        @endif
                    </div>
                </div>
                @if($carrinho)
                    <div>
                        <a href="{{URL::to('checkout/finalizar')}}" class="button yellow full-width uppercase btn-small">{{trans('carrinho.finalizar_compra')}}</a>
                    </div>
                @endif            
        </div>
    </div>
</section>
@stop