<footer id="footer">
            <div class="footer-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <h2>{{trans('footer.menu_rapido')}}</h2>
                            <ul class="discover triangle hover row">
                                <li class="col-xs-6"><a href="{{URL::to('price')}}">{{trans('menu.orcar')}}</a></li>
                                <li class="col-xs-6"><a href="{{URL::to('pacote/continentes')}}">{{trans('menu.destinos')}}</a></li>
                                <li class="col-xs-6"><a href="{{URL::to('translado')}}">{{trans('menu.translado')}}</a></li>
                                <li class="col-xs-6"><a href="{{URL::to('passeio')}}">{{trans('menu.passeios')}}</a></li>
                                <li class="col-xs-6"><a href="{{URL::to('serviconoturno')}}">{{trans('menu.servicos_noturnos')}}</a></li>
                                <li class="col-xs-6"><a href="{{URL::to('eventoespecial')}}">{{trans('menu.eventos_especiais')}}</a></li>
                                <li class="col-xs-6"><a href="{{URL::to('pacote-destaque')}}">{{trans('menu.pacote_destaque')}}</a></li>
                                <!-- <li class="col-xs-6"><a href="#">Blog Posts</a></li>
                                <li class="col-xs-6"><a href="#">Social Connect</a></li>
                                <li class="col-xs-6"><a href="#">Help Topics</a></li>
                                <li class="col-xs-6"><a href="#">Site Map</a></li>
                                <li class="col-xs-6"><a href="#">Policies</a></li> -->
                            </ul>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <h2>{{trans('menu.cambio')}}</h2>
                            <ul class="travel-news">
                                <li>                                    
                                    <div class="description" style="padding-left: 0px;">
                                        <h5 class="s-title">{{trans('menu.cotacao_dollar')}}</h5>
                                            <input type="text" disabled="disabled" value="{{Configuracao::where('param', 'cotacao_dolar')->first()->valor}}" class="form-control" style="width: 70%;">
                                        <!-- <span class="date">25 Sep, 2013</span> -->
                                    </div>
                                </li>
                                <li>                                    
                                    <div class="description" style="padding-left: 0px;">
                                        <h5 class="s-title">{{trans('menu.cotacao_euro')}}</h5>
                                            <input type="text" disabled="disabled" value="{{Configuracao::where('param', 'cotacao_euro')->first()->valor}}" class="form-control" style="width: 70%;">
                                        <!-- <span class="date">24 Sep, 2013</span> -->
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
                                        <input name="nome" type="text" class="input-text full-width" placeholder="your name" />
                                    </div>
                                    <div class="form-group">
                                        <input name="email" type="text" class="input-text full-width" placeholder="your email" />
                                    </div>
                                    <div class="form-group">
                                        <input name="phone" type="text" class="input-text full-width" placeholder="your phone" />
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn-success"> Enviar </button>
                                    </div>
                                </div>
                            </form>
                            <br />
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <h2>About FunWorldTours</h2>
                            <p>Nunc cursus libero purus ac congue arcu cursus ut sed vitae pulvinar massaidp nequetiam lore elerisque.</p>
                            <br />
                            <address class="contact-details">
                                <span class="contact-phone"><i class="soap-icon-phone"></i> 1-800-123-HELLO</span>
                                <br />
                                <a href="#" class="contact-email">leads@funworldtours.com</a>
                            </address>
                            <ul class="social-icons clearfix">
                                <li class="twitter"><a title="twitter" href="#" data-toggle="tooltip"><i class="soap-icon-twitter"></i></a></li>
                                <li class="googleplus"><a title="googleplus" href="#" data-toggle="tooltip"><i class="soap-icon-googleplus"></i></a></li>
                                <li class="facebook"><a title="facebook" href="#" data-toggle="tooltip"><i class="soap-icon-facebook"></i></a></li>
                                <li class="linkedin"><a title="linkedin" href="#" data-toggle="tooltip"><i class="soap-icon-linkedin"></i></a></li>
                                <li class="vimeo"><a title="vimeo" href="#" data-toggle="tooltip"><i class="soap-icon-vimeo"></i></a></li>
                                <li class="dribble"><a title="dribble" href="#" data-toggle="tooltip"><i class="soap-icon-dribble"></i></a></li>
                                <li class="flickr"><a title="flickr" href="#" data-toggle="tooltip"><i class="soap-icon-flickr"></i></a></li>
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