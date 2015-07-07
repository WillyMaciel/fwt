<div class="travelo-box">
    <h4>Similar Listings</h4>
    <div class="image-box style14">
        @foreach($data as $d)
            <article class="box">
                <figure>
                    <a href="{{URL::to(strtolower($d->class_name) . "/show/$d->id")}}"><img src="{{$caminho}}70x70_{{$d->imagem}}" alt="" /></a>
                </figure>
                <div class="details">
                    <h5 class="box-title"><a href="{{URL::to(strtolower($d->class_name) . "/show/$d->id")}}">@if(Session::get('lang') == 'pt') {{$d->nome_br}} @else {{$d->nome_en}} @endif</a></h5>
                    <label class="price-wrapper">
                        <span class="price-per-unit">{{$d->pais->name}}</span>
                    </label>
                </div>
            </article>
        @endforeach
    </div>
</div>