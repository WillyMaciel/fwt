@extends('templates.home')

@section('scripts')
    <script type="text/javascript" src="js/CardValidator.js"></script>

    <script type="text/javascript">

    tjq(document).ready(function()
    {
        var submit = false;

        tjq("#card_number").blur(function()
        {
            validate();
        });

        tjq('form').submit(function(event)
        {
            var submit = validate();
            if(!submit || tjq("#card_brand_input").val() == '')
            {
                alert('There is a problem with your credit card number, please correct!');
                return false;
            }
        });

    });

    function validate()
    {
        var card = tjq("#card_number").validateCreditCard({ accept: ['visa', 'mastercard'] });

            if(card.valid)
            {
                if (card.card_type.name == 'visa')
                {
                    tjq("#cartaoflag").html('<img src="images/card/visa.png">');
                    submit = true;
                    tjq("#card_brand_input").val('Visa');
                }
                else if(card.card_type.name == 'mastercard')
                {
                    tjq("#cartaoflag").html('<img src="images/card/mastercard.png">');
                    submit = true;
                    tjq("#card_brand_input").val('Mastercard');
                }
                else
                {
                    tjq("#cartaoflag").html('');
                    submit = false;
                    tjq("#card_brand_input").val('');
                }
            }
            else
            {
                tjq("#cartaoflag").html('');
                submit = false;
                tjq("#card_brand_input").val('');
            }

            return submit
    }

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
                                    <form action="{{URL::to('checkout/send-order')}}" method="POST" style="padding-left:4.6em;">
                                        <h2>Payment details</h2>
                                        <ul>
                                            <li>
                                                <label for="card_number">Card number </label>
                                                <input type="text" name="card_number" id="card_number" placeholder="1234 5678 9012 3456">
                                                <span id="cartaoflag"></span><br />
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
                                                    @if(Session::get('lang') == 'pt')
                                                    <li>
                                                        <label for="nometitular">CPF</label>
                                                        <input type="text" name="cpftitular" id="cpftitular" value="">
                                                    </li>
                                                    @else
                                                    <li>
                                                        <label for="nometitular">Passaport</label>
                                                        <input type="text" name="passaportetitular" id="passaportetitular" value="">
                                                    </li>
                                                    @endif
                                                    <li>
                                                        <label for="expiry_date">Expiry date</label>
                                                        <select name="mes_cartao" id="mes_cartao">
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
                                                        <select name="ano_cartao" style="width:70px !important;" id="ano_cartao">
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
                                                    @if(Session::get('lang') == 'pt')
                                                    <li>
                                                        <label for="cvv">Parcelas</label>
                                                        {{Form::select('parcelas', $parcelas)}}
                                                        <input type="hidden" name="pedido_id" value="{{$pedido->id}}" />
                                                        <input type="hidden" id="card_brand_input" name="card_brand" value="" />
                                                    </li>
                                                    @endif
                                                    <li style="padding-top: 20px;" style="">
                                                        <div style="padding-top: 1.6em;padding-right: 2.6em;">
                                                            <button type="submit" class="btn-medium icon-check uppercase full-width">Efetuar Pagamento</button>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </form>
                                </div>

                </div>

            </div>
            <div class="col-sm-8 col-md-9 hotel-list listing-style3 hotel">

                <article class="box" style="padding-left: 2.6em;
padding-top: 1.6em;">
                        <h2 class="tab-content-title"> Produtos</h2>

                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Preço Unitário</th>
                                    <th>Quantidade</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pedido->produtos as $produto)
                                    <tr>
                                        <td>{{$produto->pivot->nome_br}} {{$produto->pivot->tipo or ''}} </td>
                                        <td>{{$produto->pivot->preco}}</td>
                                        <td>{{$produto->pivot->quantidade}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>Nenhum produto encontrado</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div id="total">
                            <h2> Total: {{$pedido->total}} </h2>
                        </div>

                </article>




            </div>
        </div>
    </div>
</div>
@stop