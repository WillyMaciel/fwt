<footer id="footer">
            <div class="footer-wrapper">
                <div class="container">
                    <div class="row">

                            <div class="col-sm-6 col-md-4">
                                <h2>{{trans('footer.menu_rapido')}}</h2>
                                <ul class="discover triangle hover row">
                                    <li class="col-xs-6"><a href="{{URL::to('price')}}">{{trans('menu.orcar')}}</a></li>
                                    <li class="col-xs-6"><a href="{{URL::to('pacote/continentes')}}">{{trans('menu.destinos')}}</a></li>
                                    <li class="col-xs-6"><a href="{{URL::to('translado')}}">{{trans('menu.translado')}}</a></li>
                                    <li class="col-xs-6"><a href="{{URL::to('passeio')}}">{{trans('menu.passeios')}}</a></li>
                                    <li class="col-xs-6"><a href="{{URL::to('serviconoturno')}}">{{trans('menu.servicos_noturnos')}}</a></li>
                                    <li class="col-xs-6"><a href="{{URL::to('eventoespecial')}}">{{trans('menu.eventos_especiais')}}</a></li>
                                    <li class="col-xs-6"><a href="{{URL::to('pacote-destaque')}}">{{trans('menu.pacote_destaque')}}</a></li>
                                    <li class="col-xs-6"><a href="{{URL::to('pages/about-us')}}">{{trans('paginas.sobre_nos')}}</a></li>
                                    <li class="col-xs-6"><a href="{{URL::to('pages/terms-of-service')}}">{{trans('paginas.termos_de_servico')}}</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-6 col-md-2">
                                <h2>{{trans('menu.cambio')}}</h2>
                                <ul class="travel-news">
                                    <li>
                                        <div class="description" style="padding-left: 0px;">
                                            <h5 class="s-title">{{trans('menu.cotacao_dollar')}}</h5>
                                                <input type="text" disabled="disabled" value="{{Configuracao::where('param', 'cotacao_dolar')->first()->valor}}" class="form-control" style="width: 70%;">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="description" style="padding-left: 0px;">
                                            <h5 class="s-title">{{trans('menu.cotacao_euro')}}</h5>
                                                <input type="text" disabled="disabled" value="{{Configuracao::where('param', 'cotacao_euro')->first()->valor}}" class="form-control" style="width: 70%;">
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <h2>Request a Callback</h2>
                                <p>Interested in our services? Let us get in touch to offer customized services!</p>
                                <br />
                                <form method="POST" action="{{URL::to('mailing/')}}">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input name="nome" type="text" class="input-text full-width" placeholder="{{trans('contato.seu_nome')}}" />
                                        </div>
                                        <div class="form-group">
                                            <input name="email" type="text" class="input-text full-width" placeholder="{{trans('contato.seu_email')}}" />
                                        </div>
                                        <div class="form-group">
                                            <input name="phone" type="text" class="input-text full-width" placeholder="{{trans('contato.seu_telefone')}}" />
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn-success"> {{trans('contato.enviar')}} </button>
                                        </div>
                                    </div>
                                </form>
                                <br />
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <h2>About FunWorldTours</h2>
                                <p>Fun World Tours was founded to help tourists in reaching and having access to the best events in South America & etc</p>
                                <br />
                                <address class="contact-details">
                                    <span class="contact-phone"><i class="soap-icon-phone"></i> 617 938 3717</span>
                                    <br />
                                    <a href="#" class="contact-email">leads@funworldtours.com</a>
                                </address>
                                <ul class="social-icons clearfix">
                                    <li class="googleplus"><a title="googleplus" href="#" data-toggle="tooltip"><i class="soap-icon-googleplus"></i></a></li>
                                    <li class="facebook"><a title="facebook" href="https://www.facebook.com/funworldtravel?fref=ts" data-toggle="tooltip"><i class="soap-icon-facebook"></i></a></li>
                                    <li class="linkedin"><a title="linkedin" href="#" data-toggle="tooltip"><i class="soap-icon-linkedin"></i></a></li>
                                </ul>
                            </div>

                    </div>
                </div>
            </div>
            <div class="bottom gray-area">
                <div class="container">
                    <div class="logo pull-left">
                        <a href="index.html" title="Travelo - home">
                            <img src="images/logo.png" alt="Travelo HTML5 Template" width="260px" height="40px" />
                        </a>
                    </div>
                    <div class="pull-right">
                        <a id="back-to-top" href="#" class="animated" data-animation-type="bounce"><i class="soap-icon-longarrow-up circle"></i></a>
                    </div>
                    <div class="copyright pull-right">
                        <p>&copy; 2015 Fun World Tours</p>
                    </div>
                </div>
            </div>
        </footer>