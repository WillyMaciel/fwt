<header id="header" class="navbar-static-top">
            <div class="topnav hidden-xs">
                <div class="container">
                    <ul class="quick-menu pull-left">
                        <!-- <li><a href="#">My Account</a></li> -->
                        <li class="ribbon">
                            <a href="#">
                                @if(Config::get('app.locale') == 'pt')
                                    Português
                                    {? $extra_lang = 'English' ?}
                                @else
                                    English
                                    {? $extra_lang = 'Portuguese' ?}
                                @endif
                            </a>
                            <ul class="menu mini">
                                <li><a href="{{URL::to('lang?lang='. $extra_lang)}}" title="{{$extra_lang}}">{{$extra_lang}}</a></li>
                            </ul>
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
                            <img src="images/logo.png" alt="Fun World Tours" />
                        </a>
                    </h1>

                    <nav id="main-menu" role="navigation">
                        <ul class="menu">
                            <li class="menu-item-has-children">
                                <a href="admin/">{{trans('menu.painel')}}</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a> {{trans('menu.catalogo')}} </a>
                                <ul>
                                    <!-- <li><a href="{{URL::to('admin/destino')}}">{{trans('menu.destinos')}}</a></li> -->
                                    <li><a href="{{URL::to('admin/continente')}}">Continentes</a></li>
                                    <li><a href="{{URL::to('admin/pais')}}">Paises</a></li>
                                    <li><a href="{{URL::to('admin/pacote')}}">{{trans('menu.pacotes')}}</a></li>
                                    <li><a href="{{URL::to('admin/hotel')}}">{{trans('menu.hoteis')}}</a></li>
                                    <li><a href="{{URL::to('admin/apartamento')}}">Apartamentos</a></li>
                                    <li><a href="{{URL::to('admin/translado')}}">{{trans('menu.translado')}}</a></li>
                                    <li><a href="{{URL::to('admin/passeio')}}">{{trans('menu.passeios')}}</a></li>
                                    <li><a href="{{URL::to('admin/serviconoturno')}}">{{trans('menu.servicos_noturnos')}}</a></li>
                                    <li><a href="{{URL::to('admin/eventoespecial')}}">{{trans('menu.eventos_especiais')}}</a></li>
                                    <li><a href="{{URL::to('admin/pacote-destaque')}}">{{trans('menu.pacote_destaque')}}</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a> {{trans('menu.vendas')}} </a>
                                <ul>
                                    <li><a href="{{URL::to('admin/pedido')}}">{{trans('menu.pedidos')}}</a></li>
                                    <li><a href="{{URL::to('admin/produto-personalizado')}}">Produtos Personalizados</a></li>
                                    <li><a href="{{URL::to('admin/usuario')}}">{{trans('menu.usuarios')}}</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a> {{trans('menu.loja')}} </a>
                                <ul>
                                    <li><a href="{{URL::to('admin/mailing')}}">{{trans('menu.mailing')}}</a></li>
                                    <li><a href="{{URL::to('admin/configuracao')}}">Configurações</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="/"> {{trans('menu.ir_loja')}} </a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <nav id="mobile-menu-01" class="mobile-menu collapse">
                    <ul id="mobile-primary-menu" class="menu">
                        <li class="menu-item-has-children">
                                <a href="/">Home</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="hotel-index.html">{{trans('menu.hoteis')}}</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="car-index.html">{{trans('menu.translado')}}</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="cruise-index.html">{{trans('menu.passeios')}}</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="flight-index.html">{{trans('menu.servicos_noturnos')}}</a>
                            </li>
                             <li class="menu-item-has-children">
                                <a href="flight-index.html">{{trans('menu.eventos_especiais')}}</a>
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