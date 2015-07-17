@extends('templates.home')

@section('scripts')
    <script type="text/javascript" src="js/CardValidator.js"></script>

    <script type="text/javascript">

    tjq(document).ready(function()
    {
        var submit = false;

        tjq("#card_number").blur(function()
        {
            var card = tjq("#card_number").validateCreditCard({ accept: ['visa', 'mastercard'] });

            console.log(card);

            if(card.valid)
            {
                if (card.card_type.name == 'visa')
                {
                    tjq("#cartaoflag").html('<img src="images/card/visa.png">');
                    submit = true;
                }
                else if(card.card_type.name == 'mastercard')
                {
                    tjq("#cartaoflag").html('<img src="images/card/mastercard.png">');
                    submit = true;
                }
                else
                {
                    tjq("#cartaoflag").html('');
                    submit = false;
                }
            }
            else
            {
                tjq("#cartaoflag").html('');
                submit = false;
            }
        });

        tjq('form').submit(function(event)
        {
            if(!submit)
            {
                alert('There is a problem with your credit card number, please correct!');
                return false;
            }
        });
        
    });

    </script>
@stop

@section('title')
<div class="page-title-container">
    <div class="container">
        <div class="page-title pull-left">
            <h2 class="entry-title">Checkout</h2>
        </div>
    </div>
</div>
@stop
@section('content')
<div class="container">
    <div id="main">
        <div class="row">
            <div class="col-sm-4 col-md-3">
                <h4 class="search-results-title"><i class="soap-icon-search"></i><b>Checkout</b></h4>
                <div class="toggle-container filters-container">
                    <div class="panel style1 arrow-right">

                    </div>
                    
                    <div class="panel style1 arrow-right">

                    </div>

                                <div class="panel style1 arrow-right">
                                    <form action="{{URL::to('mundipagg/order')}}" method="POST">
                                        <h2>Payment details</h2>
                                        <ul>
                                            <li>
                                                <label for="card_number">Card number </label>
                                                <input type="text" name="card_number" id="card_number" placeholder="1234 5678 9012 3456">
                                                <span id="cartaoflag"></span>
                                                <small class="help">Aceitamos Visa ou Mastercard</small>
                                            </li>
                                            <li class="vertical">
                                                <ul>
                                                    <li>
                                                        <label for="nometitular">Titular</label>
                                                        <input type="text" name="nometitular" id="nometitular" value="">
                                                    </li>
                                                    <li>
                                                        <label for="nometitular">Telefone</label>
                                                        <input type="text" name="telefonetitular" id="telefonetitular" value="">
                                                    </li>
                                                    <li>
                                                        <label for="nometitular">CPF</label>
                                                        <input type="text" name="cpftitular" id="cpftitular" value="">
                                                    </li>
                                                    <li>
                                                        <label for="expiry_date">Expiry date</label>
                                                        <select id="mes_cartao">
                                                            <option value="">MM</option>
                                                            <option value="01">01</option>
                                                            <option value="02">02</option>
                                                            <option value="03">03</option>
                                                            <option value="04">04</option>
                                                            <option value="05">05</option>
                                                            <option value="06">06</option>
                                                            <option value="07">07</option>
                                                            <option value="08">08</option>
                                                            <option value="09">09</option>
                                                            <option value="10">10</option>
                                                            <option value="11">11</option>
                                                            <option value="12">12</option>
                                                        </select>
                                                        /
                                                        <select style="width:70px !important;" id="ano_cartao">
                                                            <option value="">AAAA</option>
                                                            <option value="2015">2015</option>
                                                            <option value="2016">2016</option>
                                                            <option value="2017">2017</option>
                                                            <option value="2018">2018</option>
                                                            <option value="2019">2019</option>
                                                            <option value="2020">2020</option>
                                                            <option value="2021">2021</option>
                                                            <option value="2022">2022</option>
                                                            <option value="2023">2023</option>
                                                            <option value="2024">2024</option>
                                                            <option value="2025">2025</option>
                                                            <option value="2026">2026</option>
                                                            <option value="2027">2027</option>
                                                            <option value="2028">2028</option>
                                                            <option value="2029">2029</option>
                                                            <option value="2030">2030</option>
                                                            <option value="2031">2031</option>
                                                            <option value="2032">2032</option>
                                                            <option value="2033">2033</option>
                                                            <option value="2034">2034</option>
                                                            <option value="2035">2035</option>
                                                            <option value="2036">2036</option>
                                                            <option value="2037">2037</option>
                                                            <option value="2038">2038</option>
                                                            <option value="2039">2039</option>
                                                            <option value="2040">2040</option>
                                                        </select>
                                                    </li>
                                                    <li>
                                                        <label for="cvv">CVV (Código de segurança)</label>
                                                        <input type="text" name="cvv" id="cvv" maxlength="3" placeholder="123">
                                                    </li>
                                                    <li>
                                                        <label for="cvv">Parcelas</label>
                                                        {{Form::select('parcelas', $parcelas)}}
                                                        <!-- <select name="parcelas">
                                                            <option>1</option>
                                                            <option>2</option>
                                                        </select> -->
                                                    </li>
                                                    <li style="padding-top: 20px;">
                                                        <button type="submit" class="btn-medium icon-check uppercase full-width">Efetuar Pagamento</button>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </form>
                                </div>
                    
                </div>

            </div>
            <div class="col-sm-8 col-md-9">

            @foreach($pedido->produtos as $produto)
                    {{$produto->pivot->preco}}

                @endforeach

                <div class="hotel-list listing-style3 hotel">
                @if(isset($produtos))

                    @foreach($produtos as $p)
                        <article class="box">
                            <figure class="col-sm-5 col-md-4">
                                <a title="" href="{{URL::to("hotel/show/{$p->id}")}}" class="hover-effect"><img width="270" height="160" alt="" src="@if(isset($p->imagem)) uploads/hoteis/270x160_{{$p->imagem}} @else http://placehold.it/270x160 @endif"></a>
                            </figure>
                            <div class="details col-sm-7 col-md-8">
                                <div>
                                    <div>
                                        <h4 class="box-title"><a href="{{URL::to("hotel/show/{$p->id}")}}"> @if(Session::get('lang') == 'pt') {{$p->nome_br}} @else {{$p->nome_en}} @endif </a><small><i class="soap-icon-departure yellow-color"></i> {{$p->pais->name}} - {{$p->estado}} </small></h4>
                                        <div class="amenities">
                                            @foreach($p->caracteristicas as $c)
                                                <i class="{{$c->icone}} circle"></i>
                                            @endforeach

                                        </div>
                                    </div>
                                    <div>
                                        <div title="" class="five-stars-container" data-toggle="tooltip" data-placement="bottom" data-original-title="{{$p->estrelas or 0}} Estrelas">
                                                <span class="five-stars" style="width: {{$p->estrelas * 20}}%;"></span>
                                        </div>
                                        <span class="review">{{$p->estrelas or 0}} {{trans('hotel.estrelas')}}</span>
                                    </div>
                                </div>
                                <div>
                                    <p>@if(Session::get('lang') == 'pt') {{substr($p->descricao_br, 0, 150) . ' ...'}} @else {{substr($p->descricao_en, 0, 150) . ' ...'}} @endif</p>
                                    <div>
                                        <span class="price"><small>{{trans('hotel.preco_noite')}}</small>{{$p->valor}}</span>
                                        <a class="button btn-small full-width text-center" title="" href="{{URL::to("hotel/show/{$p->id}")}}">{{trans('hotel.selecionar')}}</a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach                    
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