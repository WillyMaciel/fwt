<header id="header" class="navbar-static-top">
            <div class="topnav hidden-xs">
                <div class="container">
                    <ul class="quick-menu pull-left">
                        @include('common.menu.partes.nav_lang')
                    </ul>
                    <ul class="quick-menu pull-right">
                        <!-- Menu de usuário logado e deslogado, exibe carrinho e etc -->
                        @include('common.menu.partes.nav_usuario')
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
                            <!-- Menu principal com categorias e subcategorias -->                 
                            @include('common.menu.partes.nav_principal')
                        </ul>
                    </nav>
                </div>

                <!-- MENU MOBILE -->
                @include('common.menu.mobile')

            </div>
            @include('widgets.auth.registrobox')

            <!-- LOGIN BOX -->
            @include('widgets.auth.loginbox')
            <!-- LOGIN BOX END -->

        </header>