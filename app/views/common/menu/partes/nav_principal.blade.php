<li class="menu-item">
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
<li class="menu-item">
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
<li class="menu-item">
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