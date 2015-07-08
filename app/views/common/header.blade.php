<header id="header" class="navbar-static-top">
            <div class="topnav hidden-xs">
                <div class="container">
                    <ul class="quick-menu pull-left">
                        <!-- <li><a href="#">My Account</a></li> -->
                        <li class="ribbon">
                                @if(Config::get('app.locale') == 'pt')
                                    <a href="{{URL::to('lang?lang=Portuguese')}}">
                                    <img src="images/icon/flags/pt-br.png">
                                    {? $extra_lang = 'English' ?}
                                    {? $extra_lang_img = '<img src="images/icon/flags/en-us.png">' ?}
                                @else
                                    <a href="{{URL::to('lang?lang=English')}}">
                                    <img src="images/icon/flags/en-us.png">
                                    {? $extra_lang = 'Portuguese' ?}
                                    {? $extra_lang_img = '<img src="images/icon/flags/pt-br.png">' ?}
                                @endif
                            </a>
                            <!-- <ul class="menu mini">
                                <li><a href="{{URL::to('lang?lang='. $extra_lang)}}" title="{{$extra_lang}}">{{$extra_lang_img}}{{$extra_lang}}</a></li>
                            </ul> -->
                        </li>
                        <li>
                                <a href="{{URL::to('lang?lang='. $extra_lang)}}" title="{{$extra_lang}}">{{$extra_lang_img}}</a>
                        </li>
                    </ul>
                    <ul class="quick-menu pull-right">
                    @if(!Auth::check())
                        <li><a href="#travelo-login" class="soap-popupbox">LOGIN</a></li>
                        <li><a href="#travelo-signup" class="soap-popupbox">{{trans('menu.registrar')}}</a></li>
                    @else
                        @if(Auth::user()->is_admin == 1)
                            <li class="ribbon">
                                <a> ADMIN </a>
                            </li>
                        @endif
                        <li class="ribbon">
                            <a href="#"> {{{Auth::user()->nome}}} </a>
                            <ul class="menu mini">
                                <li><a href="{{URL::to('cliente/minhaconta')}}"> {{trans('menu.minhaconta')}} </a></li>
                                <li><a href="{{URL::to('cliente/pedido')}}"> {{trans('menu.meuspedidos')}}</a></li>
                                <li><a href="{{URL::to('users/logout')}}"> {{trans('menu.logout')}}</a></li>
                            </ul>
                        </li>
                    @endif

                    <li><a href="{{URL::to('carrinho')}}" >CARRINHO @if(Session::has('carrinho')) ({{count(Session::get('carrinho'))}}) @else (0)  @endif</a></li>
                        <!-- <li class="ribbon currency">
                            <a href="#" title="">USD</a>
                            <ul class="menu mini">
                                <li><a href="#" title="AUD">AUD</a></li>
                                <li><a href="#" title="BRL">BRL</a></li>
                                <li class="active"><a href="#" title="USD">USD</a></li>
                                <li><a href="#" title="CAD">CAD</a></li>
                                <li><a href="#" title="CHF">CHF</a></li>
                                <li><a href="#" title="CNY">CNY</a></li>
                                <li><a href="#" title="CZK">CZK</a></li>
                                <li><a href="#" title="DKK">DKK</a></li>
                                <li><a href="#" title="EUR">EUR</a></li>
                                <li><a href="#" title="GBP">GBP</a></li>
                                <li><a href="#" title="HKD">HKD</a></li>
                                <li><a href="#" title="HUF">HUF</a></li>
                                <li><a href="#" title="IDR">IDR</a></li>
                            </ul>
                        </li> -->
                    </ul>
                </div>
            </div>

            <div class="main-header">

                <a href="#mobile-menu-01" data-toggle="collapse" class="mobile-menu-toggle">
                    Mobile Menu Toggle
                </a>

                <div class="container">
                    <h1 class="logo navbar-brand">
                        <a href="/" title="Fun World Tours - home">
                            <img src="images/logo.png" alt="Fun World Tours" width="260px" height="40px" />
                        </a>
                    </h1>

                    <nav id="main-menu" role="navigation">
                        <ul class="menu">
                            <!-- <li class="menu-item-has-children">
                                <a href="/">Home</a>
                            </li> -->
                            <li class="menu-item-has-children">
                                <a href="{{URL::to('price')}}">{{trans('menu.orcar')}}</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{URL::to('pacote/continentes')}}">{{trans('menu.destinos')}}</a>
                                <ul>
                                    <?php
                                        $continentes = Continente::whereHas('pacotes', function($query)
                                        {
                                            $query->Where('publicado', '=', 1);
                                        })->get();

                                        debug($continentes);
                                    ?>
                                    @foreach($continentes as $cont)
                                        <li><a href="{{URL::to("pacote/paises/?continente={$cont->name_pt}")}}">@if(Session::get('lang') == 'pt') {{$cont->name_pt}} @else {{$cont->name_en}} @endif</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <!-- <li class="menu-item-has-children">
                                <a href="{{URL::to('hotel')}}">{{trans('menu.hoteis')}}</a>
                            </li> -->
                            <li class="menu-item-has-children">
                                <a href="{{URL::to('translado')}}">{{trans('menu.translado')}}</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{URL::to('passeio')}}">{{trans('menu.passeios')}}</a>
                                <ul>
                                    <li><a href="{{URL::to('passeio?tipo=Esportes')}}">{{trans('menu.esportes')}}</a></li>
                                    <li><a href="{{URL::to('passeio?tipo=Trilhas')}}">{{trans('menu.trilhas')}}</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{URL::to('serviconoturno')}}">{{trans('menu.servicos_noturnos')}}</a>
                                <ul>
                                    <li><a href="{{URL::to('serviconoturno?tipo=Restaurante')}}">{{trans('menu.restaurantes')}}</a></li>
                                    <li><a href="{{URL::to('serviconoturno?tipo=Evento')}}">{{trans('menu.eventos')}}</a></li>
                                    <li><a href="{{URL::to('serviconoturno?tipo=Boate')}}">{{trans('menu.boates')}}</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{URL::to('eventoespecial')}}">{{trans('menu.eventos_especiais')}}</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{URL::to('pacote-destaque')}}">{{trans('menu.pacote_destaque')}}</a>
                                <ul>
                                    <li><a href="{{URL::to('pacote-destaque?tipo=GayFriendly')}}">{{trans('menu.gay_friendly')}}</a></li>
                                    <li><a href="{{URL::to('pacote-destaque?tipo=Bachelor')}}">{{trans('menu.despedida_solteiro')}}</a></li>
                                    <li><a href="{{URL::to('pacote-destaque?tipo=Honeymoon')}}">{{trans('menu.lua_de_mel')}}</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>

                <nav id="mobile-menu-01" class="mobile-menu collapse">
                    <ul id="mobile-primary-menu" class="menu">
                        <!-- <li class="menu-item-has-children">
                                <a href="/">Home</a>
                            </li> -->
                            <li class="menu-item-has-children">
                                <a href="{{URL::to('price')}}">{{trans('menu.orcar')}}</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{URL::to('pacote')}}">{{trans('menu.destinos')}}</a>
                                <ul>
                                    <?php $continentes = Continente::all(); ?>
                                    @foreach($continentes as $cont)
                                        <li><a href="#">@if(Session::get('lang') == 'pt') {{$cont->name_pt}} @else {{$cont->name_en}} @endif</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{URL::to('hotel')}}">{{trans('menu.hoteis')}}</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{URL::to('translado')}}">{{trans('menu.translado')}}</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{URL::to('passeio')}}">{{trans('menu.passeios')}}</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{URL::to('serviconoturno')}}">{{trans('menu.servicos_noturnos')}}</a>
                                <ul>
                                    <li><a href="{{URL::to('serviconoturno?tipo=Restaurante')}}">{{trans('menu.restaurantes')}}</a></li>
                                    <li><a href="{{URL::to('serviconoturno?tipo=Evento')}}">{{trans('menu.eventos')}}</a></li>
                                    <li><a href="{{URL::to('serviconoturno?tipo=Boate')}}">{{trans('menu.boates')}}</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{URL::to('servico_noturno')}}">{{trans('menu.eventos_especiais')}}</a>
                                <ul>
                                    <li><a href="#">{{trans('menu.gay_friendly')}}</a></li>
                                    <li><a href="#">{{trans('menu.despedida_solteiro')}}</a></li>
                                    <li><a href="#">{{trans('menu.lua_de_mel')}}</a></li>
                                </ul>
                            </li>
                    </ul>

                    <ul class="mobile-topnav container">
                        <li><a href="#">MY ACCOUNT</a></li>
                        <li class="ribbon">
                            <a href="#">Português</a>
                            <ul class="menu mini">
                                <li><a href="#" title="English">English</a></li>
                                <!-- <li><a href="#" title="Español">Español</a></li> -->
                                <li class="active"><a href="#" title="Português">Português</a></li>
                            </ul>
                        </li>
                        <li><a href="#travelo-login" class="soap-popupbox">LOGIN</a></li>
                        <li><a href="#travelo-signup" class="soap-popupbox">SIGNUP</a></li>
                        <!-- <li class="ribbon currency menu-color-skin">
                            <a href="#">USD</a>
                            <ul class="menu mini">
                                <li><a href="#" title="AUD">AUD</a></li>
                                <li><a href="#" title="BRL">BRL</a></li>
                                <li class="active"><a href="#" title="USD">USD</a></li>
                                <li><a href="#" title="CAD">CAD</a></li>
                                <li><a href="#" title="CHF">CHF</a></li>
                                <li><a href="#" title="CNY">CNY</a></li>
                                <li><a href="#" title="CZK">CZK</a></li>
                                <li><a href="#" title="DKK">DKK</a></li>
                                <li><a href="#" title="EUR">EUR</a></li>
                                <li><a href="#" title="GBP">GBP</a></li>
                                <li><a href="#" title="HKD">HKD</a></li>
                                <li><a href="#" title="HUF">HUF</a></li>
                                <li><a href="#" title="IDR">IDR</a></li>
                            </ul>
                        </li> -->
                    </ul>

                </nav>
            </div>
            @include('widgets.auth.registrobox')

            <!-- LOGIN BOX -->
            @include('widgets.auth.loginbox')
            <!-- LOGIN BOX END -->

        </header>