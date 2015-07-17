@extends('templates.home')
@section('content')
<section id="content" class="gray-area">
    <div class="container">
        <div id="main">
            @include('elements.alerts')
            <div class="tab-container full-width-style arrow-left dashboard">
                <ul class="tabs">
                    <li class="active"><a data-toggle="tab" href="#booking"><i class="soap-icon-anchor circle"></i>Pedidos</a></li>
                </ul>
                <div class="tab-content">
                    <div id="booking" class="tab-pane fade in active">
                        <h2>Seus Pedidos</h2>

                        <div class="booking-history">
                            @if($pedidos)
                                @foreach($pedidos as $pedido)
                                <div class="booking-info clearfix">
                                    <div class="date">
                                        <label class="month">ID</label>
                                        <label class="date">{{$pedido->id}}</label>
                                    </div>
                                    <h4 class="box-title"><i class="icon soap-icon-hotel blue-color circle"></i><a href="cliente/pedido/{{$pedido->id}}"> Ver itens deste pedido </a></h4>
                                    <dl class="info">
                                        <dt>ID DO PEDIDO</dt>
                                        <dd>{{$pedido->id}}</dd>
                                        <dt>Pedido feito em:</dt>
                                        <dd>{{date('l, M d, Y', strtotime($pedido->created_at))}}</dd>
                                    </dl>
                                    <button class="btn-mini status">@if(Session::get('lang') == 'pt') {{$pedido->status->nome_br}} @else {{$pedido->status->nome_en}} @endif</button>
                                    @if($pedido->status->id == 12)
                                        <a href="{{URL::to("checkout/order/$pedido->id")}}"> <button type="button" class="btn-medium icon-check uppercase full-width">Efetuar Pagamento do pedido {{$pedido->id}}</button> </a>
                                    @endif
                                </div>
                                @endforeach

                            @else

                                <div class="booking-info clearfix">
                                        <h2> Seu pacote esta vazio! </h2>
                                </div>

                            @endif
                        </div>
                    </div>       
                </div>
            </div>
        </div>
    </div>
</section>
@stop