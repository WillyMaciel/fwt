<nav id="mobile-menu-01" class="mobile-menu collapse">
    <ul id="mobile-primary-menu" class="menu">
        <!-- Menu principal com categorias e subcategorias -->
        @include('common.menu.partes.nav_principal')
    </ul>

    <ul class="mobile-topnav container">
        <!-- Menu de linguagem -->
        @include('common.menu.partes.nav_lang')

        <!-- Menu de usuário logado e deslogado, exibe carrinho e etc -->
        @include('common.menu.partes.nav_usuario')
    </ul>

</nav>