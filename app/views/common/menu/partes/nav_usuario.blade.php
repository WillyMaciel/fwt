@if(!Auth::check())
    <li><a href="#travelo-login" class="soap-popupbox">LOGIN</a></li>
    <li><a href="#travelo-signup" class="soap-popupbox">{{trans('menu.registrar')}}</a></li>
@else
    @if(Auth::user()->is_admin == 1)
        <li>
            <a> ADMIN </a>
        </li>
    @endif
    <li class="ribbon language">
        <a href="#"> {{{Auth::user()->nome}}} </a>
        <ul class="menu mini">
            <li><a href="{{URL::to('cliente/minhaconta')}}"> {{trans('menu.minhaconta')}} </a></li>
            <li><a href="{{URL::to('cliente/pedido')}}"> {{trans('menu.meuspedidos')}}</a></li>
            <li><a href="{{URL::to('users/logout')}}"> {{trans('menu.logout')}}</a></li>
        </ul>
    </li>
@endif

<li><a href="{{URL::to('carrinho')}}" >{{trans('menu.carrinho')}} @if(Session::has('carrinho')) ({{count(Session::get('carrinho'))}}) @else (0)  @endif</a></li>