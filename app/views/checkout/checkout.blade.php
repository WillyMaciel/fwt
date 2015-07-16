@extends('templates.home')

@section('scripts')
    <script type="text/javascript" src="js/CreditCard.js"></script>

    <script type="text/javascript">

    $(document).ready(function()
    {
        alert('teste');
    });

    </script>
@stop

@section('content')

<section id="content" class="gray-area">
    <div class="container">
        <div id="main">
            @include('elements.alerts')
            <div class="tab-container full-width-style arrow-left dashboard">


                        <div class="row">

                            <div class="col-md-12">
                                <h1> Produtos </h1>
                            </div>

                            <div class="col-md-12">
                                <div class="demo">
                                    <h3 id="try-it">Try it</h3>
                                    <div class="numbers" style="display: none;">
                                        <p>Try some of these numbers:</p>
                                        <ul class="list">
                                            <li><a href="#">4000 0000 0000 0002</a></li>
                                            <li><a href="#">4026 0000 0000 0002</a></li>
                                            <li><a href="#">5018 0000 0009</a></li>
                                            <li><a href="#">5100 0000 0000 0008</a></li>
                                            <li><a href="#">6011 0000 0000 0004</a></li>
                                        </ul>
                                    </div>
                                    <form>
                                        <h4>Payment details</h4>
                                        <ul>
                                            <li>
                                                <label for="card_number">Card number (<a id="sample-numbers-trigger" href="#">try one of these</a>)</label>
                                                <input type="text" name="card_number" id="card_number" placeholder="1234 5678 9012 3456">
                                                <small class="help">This demo supports Visa, Visa Electron, Maestro, MasterCard and Discover. <a href="#supported-cards">The plugin recognises many more cards</a>.</small>
                                            </li>
                                            <li class="vertical">
                                                <ul>
                                                    <li>
                                                        <label for="expiry_date">Expiry date</label>
                                                        <input type="text" name="expiry_date" id="expiry_date" maxlength="5" placeholder="mm/yy">
                                                    </li>
                                                    <li>
                                                        <label for="cvv">CVV</label>
                                                        <input type="text" name="cvv" id="cvv" maxlength="3" placeholder="123">
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="vertical maestro" style="display: none; opacity: 0;">
                                                <ul>
                                                    <li>
                                                        <label for="issue_date">Issue date</label>
                                                        <input type="text" name="issue_date" id="issue_date" maxlength="5" placeholder="mm/yy">
                                                    </li>
                                                    <li>
                                                        <span class="or">or</span>
                                                        <label for="issue_number">Issue number</label>
                                                        <input type="text" name="issue_number" id="issue_number" maxlength="2">
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <label for="name_on_card">Name on card</label>
                                                <input type="text" name="name_on_card" id="name_on_card" placeholder="A Sample">
                                            </li>
                                        </ul>
                                    </form>
                                </div>
                            </div>


                            <div class="col-md-12">

                                <table style="width:100%;padding: 10px 10px 10px 10px;">
                                    <tbody>
                                        <tr>
                                            <td style="width:60%">
                                                <b>Pagar com Cartão Débito:</b><br>
                                                <a href="javascript:void(0);" onclick="Debito('electron')"><img class="ccs_loja5" id="electron" width="65" src="app/buypageloja/images/electron.gif" border="0" style="opacity: 0.1;"></a>
                                                <a href="javascript:void(0);" onclick="Debito('maestro')"><img class="ccs_loja5" id="maestro" width="65" src="app/buypageloja/images/maestro.gif" border="0" style="opacity: 0.1;"></a>
                                                <br>
                                                <b>Pagar com Cartão Crédito:</b><br>
                                                <a href="javascript:void(0);" onclick="Parcelado('visa')"><img class="ccs_loja5" id="visa" width="65" src="app/buypageloja/images/visa.gif" border="0" style="opacity: 1;"></a><a href="javascript:void(0);" onclick="Parcelado('mastercard')"><img class="ccs_loja5" id="mastercard" width="65" src="app/buypageloja/images/mastercard.gif" border="0" style="opacity: 0.1;"></a><a href="javascript:void(0);" onclick="Parcelado('elo')"><img class="ccs_loja5" id="elo" width="65" src="app/buypageloja/images/elo.gif" border="0" style="opacity: 0.1;"></a><a href="javascript:void(0);" onclick="Parcelado('diners')"><img class="ccs_loja5" width="65" id="diners" src="app/buypageloja/images/diners.gif" border="0" style="opacity: 0.1;"></a><a href="javascript:void(0);" onclick="Parcelado('amex')"><img class="ccs_loja5" width="65" id="amex" src="app/buypageloja/images/amex.gif" border="0" style="opacity: 0.1;"></a><a href="javascript:void(0);" onclick="Parcelado('discover')"><img class="ccs_loja5" width="65" src="app/buypageloja/images/discover.gif" id="discover" border="0" style="opacity: 0.1;"></a>
                                            </td>
                                            <td style="width:40%">
                                                <input type="hidden" value="visa" id="cc_oculto" name="cc_oculto">
                                                <table id="pagamento_parcelado">
                                                    <tbody>
                                                        <tr>
                                                            <td><b>Bandeira:</b></td>
                                                            <td><span id="meio_parcelado_titulo"><img src="app/buypageloja/images/visa.gif" border="0"></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Titular:</b></td>
                                                            <td><input class="naocolecopie" style="width:200px !important;" type="text" name="nometitular" id="nometitular" value=""></td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Telefone:</b></td>
                                                            <td><input style="width:120px !important;" type="text" class="telefone naocolecopie" name="telefone_parcelado" id="telefone_parcelado" value=""></td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>CPF:</b></td>
                                                            <td><input style="width:120px !important;" maxlength="11" type="text" class="cpf naocolecopie" name="cpf" id="cpf_parcelado" value=""></td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Cartão:</b></td>
                                                            <td><input onkeypress="return isNumberKey(event)" maxlength="16" class="naocolecopie" style="width:120px !important;" type="text" name="numero_cartao" id="numero_cartao" value=""></td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Válido:</b></td>
                                                            <td>
                                                                <select style="width:50px !important;" id="mes_cartao">
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
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Cod. Segurança:</b></td>
                                                            <td><input class="naocolecopie" style="width:40px;" type="text" name="cod_cartao" id="cod_cartao" value=""></td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Valor:</b></td>
                                                            <td>
                                                                <select style="width:230px !important;" id="lista_parcelas_parcelado">
                                                                    <option value="">-- Selecione o Valor --</option>
                                                                    <option value="MXwxfDI4OS4wMHxkbWx6WVE9PXxNamc1TGpBd3wxOTcyYTJjYjY0NTZhM2JkMWVmNDE4NDUzNTYxM2Q4NA==">À vista por 289.00</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td><a class="button" href="javascript:void(0);" onclick="PagarParcelado()" id="button-confirm">Pagamento Seguro!</a></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>


                        </div>

            </div>

        </div>

    </div>

</section>


@stop