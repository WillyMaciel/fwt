@extends('templates.home')
@section('content')
<div class="container">
    <div class="row">
        <div id="main" class="col-md-9">
            @include('elements.alerts')
            <div class="tab-container style1" id="hotel-main-content">
                <ul class="tabs">
                    <li class="active"><a data-toggle="tab" href="#photos-tab">photos</a></li>
                    <!-- <li><a data-toggle="tab" href="#map-tab">map</a></li>
                    <li><a data-toggle="tab" href="#steet-view-tab">street view</a></li>
                    <li><a data-toggle="tab" href="#calendar-tab">calendar</a></li>
                    <li class="pull-right"><a class="button btn-small yellow-bg white-color" href="#">TRAVEL GUIDE</a></li> -->
                </ul>
                <div class="tab-content">
                    <div id="photos-tab" class="tab-pane fade in active">
                        <div class="photo-gallery style1" data-animation="slide" data-sync="#photos-tab .image-carousel">
                            <ul class="slides">
                                <li><img src="@if($eventoespecial->imagem) uploads/eventosespeciais/900x500_{{$eventoespecial->imagem}} @else http://placehold.it/900x500}} @endif" alt="" /></li>
                                @foreach($eventoespecial->imagens as $img)
                                    <li><img src="{{$img->caminho}}900x500_{{$img->nome}}" alt="" /></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="image-carousel style1" data-animation="slide" data-item-width="70" data-item-margin="10" data-sync="#photos-tab .photo-gallery">
                            <ul class="slides">
                                <li><img src="@if($eventoespecial->imagem) uploads/eventosespeciais/900x500_{{$eventoespecial->imagem}} @else http://placehold.it/900x500}} @endif" alt="" /></li>
                                @foreach($eventoespecial->imagens as $img)
                                    <li><img src="{{$img->caminho}}70x70_{{$img->nome}}" alt="" /></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div id="map-tab" class="tab-pane fade">

                    </div>
                    <div id="steet-view-tab" class="tab-pane fade" style="height: 500px;">

                    </div>
                    <div id="calendar-tab" class="tab-pane fade">
                        <label>SELECT MONTH</label>
                        <div class="col-sm-6 col-md-4 no-float no-padding">
                            <div class="selector">
                                <select class="full-width" id="select-month">
                                    <option value="2014-6">June 2014</option>
                                    <option value="2014-7">July 2014</option>
                                    <option value="2014-8">August 2014</option>
                                    <option value="2014-9">September 2014</option>
                                    <option value="2014-10">October 2014</option>
                                    <option value="2014-11">November 2014</option>
                                    <option value="2014-12">December 2014</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="calendar"></div>
                                <div class="calendar-legend">
                                    <label class="available">available</label>
                                    <label class="unavailable">unavailable</label>
                                    <label class="past">past</label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <p class="description">
                                    The calendar is updated every five minutes and is only an approximation of availability.
<br /><br />
Some hosts set custom pricing for certain days on their calendar, like weekends or holidays. The rates listed are per day and do not include any cleaning fee or rates for extra people the host may have for this listing. Please refer to the listing's Description tab for more details.
<br /><br />
We suggest that you contact the host to confirm availability and rates before submitting a reservation request.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="hotel-features" class="tab-container">
                <ul class="tabs">
                    <li class="active"><a href="#hotel-description" data-toggle="tab">Description</a></li>
                    <li><a href="#whytravel" data-toggle="tab">Why Travel?</a></li>
                    <li><a href="#hotels" data-toggle="tab">Hotels</a></li>
                    <li><a href="#apartamentos" data-toggle="tab">Apts</a></li>
                    <li><a href="#hotel-reviews" data-toggle="tab">Reviews</a></li>
                    <li><a href="#hotel-things-todo" data-toggle="tab">Things to Do</a></li>
                    <li><a href="#nightlife" data-toggle="tab">Nightlife</a></li>
                    <li><a href="#hotel-write-review" data-toggle="tab">Write a Review</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="hotel-description">
                        <div class="long-description">
                            <h2>@if(Session::get('lang') == 'pt') Sobre {{$eventoespecial->nome_br}} @else About {{$eventoespecial->nome_en}} @endif</h2>
                            <p>@if(Session::get('lang') == 'pt') {{$eventoespecial->descricao_br}} @else {{$eventoespecial->descricao_en}} @endif</p>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="whytravel">
                        <div class="long-description">
                            <h2>Why Travel?</h2>
                            <p>@if(Session::get('lang') == 'pt') {{$eventoespecial->whytravel_br}} @else {{$eventoespecial->whytravel_en}} @endif</p>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="hotels">
                        <h2>Hotels</h2>
                        <p>All of the accommodations offered on our site have been personally inspected by us to uphold the utmost quality standards of our travelers. We base our selection on Service, Cleanliness, and Location. FunWorldTours offers 5 star, 4 star, & 3 star accommodations.The hotels below are based on our picks of hotels, we work with most if not all hotels in {{$eventoespecial->cidade}}.</p>
                        <div class="activities image-box style2 innerstyle">
                            @forelse($hoteis as $h)
                                <article class="box">
                                    <figure>
                                        <a title="" href="{{URL::to("hotel/show/{$h->id}")}}" class="hover-effect"><img width="270" height="160" alt="" src="@if(isset($h->imagem)) uploads/hoteis/270x160_{{$h->imagem}} @else http://placehold.it/270x160 @endif"></a>
                                    </figure>
                                    <div class="details">
                                        <div class="details-header">
                                            <div>
                                                <div title="" class="five-stars-container" data-toggle="tooltip" data-placement="bottom" data-original-title="{{$h->estrelas or 0}} Estrelas">
                                                        <span class="five-stars" style="width: {{$h->estrelas * 20}}%;"></span>
                                                </div>
                                                <span class="review">{{$h->estrelas or 0}} {{trans('hotel.estrelas')}}</span>
                                            </div>
                                            <h4 class="box-title">@if(Session::get('lang') == 'pt') {{$h->nome_br}} @else {{$h->nome_en}} @endif</h4>
                                        </div>
                                        <p>@if(Session::get('lang') == 'pt') {{substr($h->descricao_br, 0, 150) . ' ...'}} @else {{substr($h->descricao_en, 0, 150) . ' ...'}} @endif</p>
                                        <a class="button" title="" href="{{URL::to("hotel/show/{$h->id}")}}">MORE</a>
                                    </div>
                                </article>
                            @empty
                                <p> There is no Hotels in this package </p>
                            @endforelse
                        </div>
                    </div>
                    <div class="tab-pane fade" id="apartamentos">
                        <h2>Apts</h2>
                        <p>All of the apartments offered on our site have been personally inspected by us to uphold the utmost quality standards of our travelers. We base our selection on Service, Cleanliness, and Location. FunWorldTours offers luxury penthouses as well as moderate accommodations.</p>
                        <div class="activities image-box style2 innerstyle">
                            @forelse($apartamentos as $p)
                                <article class="box">
                                    <figure>
                                        <a title="" href="{{URL::to("apartamento/show/{$p->id}")}}" class="hover-effect"><img width="270" height="160" alt="" src="@if(isset($p->imagem)) uploads/apartamentos/270x160_{{$p->imagem}} @else http://placehold.it/270x160 @endif"></a>
                                    </figure>
                                    <div class="details">
                                        <div class="details-header">
                                            <div>
                                                <div title="" class="five-stars-container" data-toggle="tooltip" data-placement="bottom" data-original-title="{{$p->estrelas or 0}} Estrelas">
                                                        <span class="five-stars" style="width: {{$p->estrelas * 20}}%;"></span>
                                                </div>
                                                <span class="review">{{$p->estrelas or 0}} {{trans('hotel.estrelas')}}</span>
                                            </div>
                                            <h4 class="box-title">@if(Session::get('lang') == 'pt') {{$p->nome_br}} @else {{$p->nome_en}} @endif</h4>
                                        </div>
                                        <p>@if(Session::get('lang') == 'pt') {{substr($p->descricao_br, 0, 150) . ' ...'}} @else {{substr($p->descricao_en, 0, 150) . ' ...'}} @endif</p>
                                        <a class="button" title="" href="{{URL::to("apartamento/show/{$p->id}")}}">MORE</a>
                                    </div>
                                </article>

                            @empty
                                <p> There is no apartments for this package </p>
                            @endforelse
                        </div>
                    </div>
                    <div class="tab-pane fade" id="hotel-reviews">
                        @if(!$eventoespecial->reviews->isEmpty())
                        <div class="guest-reviews">
                            <h2>Guest Reviews</h2>
                            @foreach($eventoespecial->reviews as $review)
                                <div class="guest-review table-wrapper">
                                    <div class="col-xs-3 col-md-2 author table-cell">
                                        <a href="#"><img src="http://placehold.it/270x263" alt="" width="270" height="263" /></a>
                                        <p class="name">{{$review->cliente->nome}}</p>
                                        <p class="date">{{$review->created_at}}</p>
                                    </div>
                                    <div class="col-xs-9 col-md-10 table-cell comment-container">
                                        <div class="comment-header clearfix">
                                            <h4 class="comment-title">{{$review->titulo}}</h4>
                                            <div class="review-score">
                                                <div class="five-stars-container"><div class="five-stars" style="width: {{$review->nota * 20}}%;"></div></div>
                                                <span class="score">{{$review->nota}}</span>
                                            </div>
                                        </div>
                                        <div class="comment-content">
                                            <p>{{$review->texto}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @else
                            <p> Este produto ainda não recebeu nenhuma avaliação! </p>
                        @endif
                        <!-- <a href="#" class="button full-width btn-large">LOAD MORE REVIEWS</a> -->
                    </div>
                    <div class="tab-pane fade" id="hotel-things-todo">
                        <h2>Things to do</h2>
                        <p>All of the apartments offered on our site have been personally inspected by us to uphold the utmost quality standards of our travelers. We base our selection on Service, Cleanliness, and Location. FunWorldTours offers luxury penthouses as well as moderate accommodations.</p>
                        <div class="activities image-box style2 innerstyle">
                            @foreach($passeios as $p)
                                <article class="box">
                                    <figure>
                                        <a title="" href="{{URL::to("passeio/show/{$p->id}")}}" class="hover-effect"><img width="270" height="160" alt="" src="@if(isset($p->imagem)) uploads/passeios/270x160_{{$p->imagem}} @else http://placehold.it/270x160 @endif"></a>
                                    </figure>
                                    <div class="details">
                                        <div class="details-header">
                                            <!-- <div>
                                                <div title="" class="five-stars-container" data-toggle="tooltip" data-placement="bottom" data-original-title="{{$p->estrelas or 0}} Estrelas">
                                                        <span class="five-stars" style="width: {{$p->estrelas * 20}}%;"></span>
                                                </div>
                                                <span class="review">{{$p->estrelas or 0}} {{trans('hotel.estrelas')}}</span>
                                            </div> -->
                                            <h4 class="box-title">@if(Session::get('lang') == 'pt') {{$p->nome_br}} @else {{$p->nome_en}} @endif</h4>
                                        </div>
                                        <p>@if(Session::get('lang') == 'pt') {{substr($p->descricao_br, 0, 150) . ' ...'}} @else {{substr($p->descricao_en, 0, 150) . ' ...'}} @endif</p>
                                        <a class="button" title="" href="{{URL::to("passeio/show/{$p->id}")}}">MORE</a>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nightlife">
                        <h2>NightLife</h2>
                        <p></p>
                        <div class="activities image-box style2 innerstyle">
                            @foreach($snoturnos as $s)
                                <article class="box">
                                    <figure>
                                        <a title="" href="{{URL::to("serviconoturno/show/{$s->id}")}}" class="hover-effect"><img width="270" height="160" alt="" src="@if(isset($s->imagem)) uploads/servicosnoturnos/270x160_{{$s->imagem}} @else http://placehold.it/270x160 @endif"></a>
                                    </figure>
                                    <div class="details">
                                        <div class="details-header">
                                           <!--  <div>
                                                <div title="" class="five-stars-container" data-toggle="tooltip" data-placement="bottom" data-original-title="{{$s->estrelas or 0}} Estrelas">
                                                        <span class="five-stars" style="width: {{$s->estrelas * 20}}%;"></span>
                                                </div>
                                                <span class="review">{{$s->estrelas or 0}} {{trans('hotel.estrelas')}}</span>
                                            </div> -->
                                            <h4 class="box-title">@if(Session::get('lang') == 'pt') {{$s->nome_br}} @else {{$s->nome_en}} @endif</h4>
                                        </div>
                                        <p>@if(Session::get('lang') == 'pt') {{substr($s->descricao_br, 0, 150) . ' ...'}} @else {{substr($s->descricao_en, 0, 150) . ' ...'}} @endif</p>
                                        <a class="button" title="" href="{{URL::to("serviconoturno/show/{$s->id}")}}">MORE</a>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="hotel-write-review">
                        @include('forms.review', array('action' => URL::to('review'), 'produto_id' => $eventoespecial->id))
                    </div>
                </div>

            </div>
        </div>
        <div class="sidebar col-md-3">
            <article class="detailed-logo">
                <figure>
                    <img width="114" height="85" src="@if($eventoespecial->imagem) uploads/eventosespeciais/114x85_{{$eventoespecial->imagem}} @else http://placehold.it/114x85 @endif" alt="">
                </figure>
                <div class="details">
                    <h2 class="box-title">@if(Session::get('lang') == 'pt') {{$eventoespecial->nome_br}} @else {{$eventoespecial->nome_en}} @endif<small><i class="soap-icon-departure yellow-color"></i><span class="fourty-space">@if(Session::get('lang') == 'pt') {{$eventoespecial->pais->name}} @else {{$eventoespecial->pais->name}} @endif</span></small></h2>
                    <span class="price clearfix">
                        <small class="pull-left">avg/night</small>
                        <span class="pull-right">{{$eventoespecial->valor}}</span>
                    </span>
                    <div class="feedback clearfix">
                        <div title="" class="five-stars-container" data-toggle="tooltip" data-placement="bottom" data-original-title="{{$eventoespecial->estrelas or 0}} {{trans('hotel.estrelas')}}">
                            <span class="five-stars" style="width: {{$eventoespecial->estrelas * 20}}%;"></span>
                        </div>
                        <span class="review pull-right">{{$eventoespecial->estrelas or 0}} {{trans('hotel.estrelas')}}</span>
                    </div>
                        <!-- CARRINHO -->
                        <form action="{{URL::to('carrinho/add')}}" method="POST">
                            <input type="hidden" name="produto" value="{{$eventoespecial->id}}" />
                            <button type="submit" class="button yellow full-width uppercase btn-small">{{trans('hotel.comprar')}}</button>
                        </form>
                </div>
            </article>
            <div class="travelo-box contact-box">
                <h4>Need Help?</h4>
                <p>We would be more than happy to help you. Our team advisor are 24/7 at your service to help you.</p>
                <address class="contact-details">
                    <span class="contact-phone"><i class="soap-icon-phone"></i> 1-800-123-HELLO</span>
                    <br>
                    <a class="contact-email" href="#">contato@funworldtours.com</a>
                </address>
            </div>

            <!-- SIMILAR LISTING -->
                {{$similar_listing}}
            <!-- SIMILAR LISTING END -->

            <div class="travelo-box book-with-us-box">
                <h4>Why Book with us?</h4>
                <ul>
                    <li>
                        <i class="soap-icon-hotel-1 circle"></i>
                        <h5 class="title"><a href="#">135,00+ Hotels</a></h5>
                        <p>Nunc cursus libero pur congue arut nimspnty.</p>
                    </li>
                    <li>
                        <i class="soap-icon-savings circle"></i>
                        <h5 class="title"><a href="#">Low Rates &amp; Savings</a></h5>
                        <p>Nunc cursus libero pur congue arut nimspnty.</p>
                    </li>
                    <li>
                        <i class="soap-icon-support circle"></i>
                        <h5 class="title"><a href="#">Excellent Support</a></h5>
                        <p>Nunc cursus libero pur congue arut nimspnty.</p>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>
@stop