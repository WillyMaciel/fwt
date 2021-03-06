@extends('templates.home')
@section('content')
<section id="content" class="gray-area">
    <div class="container">
        <div id="main">
            <div class="tab-container full-width-style arrow-left dashboard">
                <ul class="tabs">
                    <li class="active"><a data-toggle="tab" href="#booking"><i class="soap-icon-anchor circle"></i>Seu Pedido</a></li>
                </ul>
                <div class="tab-content">
                    <div id="booking" class="tab-pane fade in active">
                        <h2>Itens do seu pedido de Numero #{{$pedido->id}}</h2>
                        <button class="btn-mini status">{{$pedido->status->nome_br}}</button>

                        <div class="booking-history">
                            @if($pedido)
                                @foreach($pedido->produtos as $produto)
                                <div class="booking-info clearfix">
                                    <div class="date">
                                        <img src="{{URL::to('images/logo_icon.png')}}" class="img-responsive">
                                    </div>
                                    <h4 class="box-title"><i class="icon soap-icon-hotel blue-color circle"></i><a href="{{URL::to(strtolower($produto->class_name) . "/show/$produto->id")}}"> @if(Session::get('lang') == 'pt') {{$produto->pivot->nome_br}} @else {{$produto->pivot->nome_en}} @endif </a><small>{{$produto->tipo}}</small></h4>
                                    <!-- <dl class="info">
                                        <dt>TRIP ID</dt>
                                        <dd>5754-8dk8-8ee</dd>
                                        <dt>booked on</dt>
                                        <dd>saturday, nov 23, 2013</dd>
                                    </dl> -->
                                    <!-- <button class="btn-mini status">UPCOMMING</button> -->
                                </div>
                                @endforeach

                            @else

                                <div class="booking-info clearfix">
                                        <h2> Seu pacote esta vazio! </h2>
                                </div>

                            @endif
                        </div>
                    </div> 
                    <!-- <div> 
                        <a href="{{URL::to('checkout/finalizar')}}" class="button yellow full-width uppercase btn-small">{{trans('carrinho.finalizar_compra')}}</a> 
                    </div>  -->                  
                </div>
            </div>
        </div>
    </div>
</section>
@stop