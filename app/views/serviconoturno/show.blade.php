@extends('templates.home')
@section('content')
<div class="container">
    <div class="row">
        <div id="main" class="col-md-9">
            @include('elements.alerts')
            <div class="tab-container style1" id="hotel-main-content">
                <ul class="tabs">
                    <li class="active"><a data-toggle="tab" href="#photos-tab">photos</a></li>
                </ul>
                <div class="tab-content">
                    <div id="photos-tab" class="tab-pane fade in active">
                        <div class="photo-gallery style1" data-animation="slide" data-sync="#photos-tab .image-carousel">
                            <ul class="slides">
                                <li><img src="@if($serviconoturno->imagem) uploads/servicosnoturnos/900x500_{{$serviconoturno->imagem}} @else http://placehold.it/900x500}} @endif" alt="" /></li>
                                @foreach($serviconoturno->imagens as $img)
                                    <li><img src="{{$img->caminho}}900x500_{{$img->nome}}" alt="" /></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="image-carousel style1" data-animation="slide" data-item-width="70" data-item-margin="10" data-sync="#photos-tab .photo-gallery">
                            <ul class="slides">
                                <li><img src="@if($serviconoturno->imagem) uploads/servicosnoturnos/900x500_{{$serviconoturno->imagem}} @else http://placehold.it/900x500}} @endif" alt="" /></li>
                                @foreach($serviconoturno->imagens as $img)
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
                    <li><a href="#hotel-reviews" data-toggle="tab">Reviews</a></li>
                    <li><a href="#hotel-write-review" data-toggle="tab">Write a Review</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="hotel-description">
                        <div class="long-description">
                            <h2>@if(Session::get('lang') == 'pt') Sobre {{$serviconoturno->nome_br}} @else About {{$serviconoturno->nome_en}} @endif</h2>
                            <p>@if(Session::get('lang') == 'pt') {{$serviconoturno->descricao_br}} @else {{$serviconoturno->descricao_en}} @endif</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="hotel-reviews">
                        @if(!$serviconoturno->reviews->isEmpty())
                        <div class="guest-reviews">
                            <h2>Guest Reviews</h2>
                            @foreach($serviconoturno->reviews as $review)
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
                    
                    <div class="tab-pane fade" id="hotel-write-review">
                        @include('forms.review', array('action' => URL::to('review'), 'produto_id' => $serviconoturno->id))
                    </div>
                </div>

            </div>
        </div>
        <div class="sidebar col-md-3">
            <article class="detailed-logo">
                <figure>
                    <img width="114" height="85" src=" @if($serviconoturno->imagem) uploads/servicosnoturnos/114x85_{{$serviconoturno->imagem}} @else http://placehold.it/114x85 @endif" alt="">
                </figure>
                <div class="details">
                    <h2 class="box-title">@if(Session::get('lang') == 'pt') {{$serviconoturno->nome_br}} @else {{$serviconoturno->nome_en}} @endif<small><i class="soap-icon-departure yellow-color"></i><span class="fourty-space">@if(Session::get('lang') == 'pt') {{$serviconoturno->pais->name}} @else {{$serviconoturno->pais->name}} @endif</span></small></h2>
                    @if($serviconoturno->tipo != 'Boate')
                        <span class="price clearfix">
                            <small class="pull-left">{{trans('carrinho.preco')}}</small>
                            <span class="pull-right">{{$serviconoturno->valor or '--'}}</span>
                        </span>
                    @endif

                    <!-- <div class="feedback clearfix">
                        <div title="" class="five-stars-container" data-toggle="tooltip" data-placement="bottom" data-original-title="{{$serviconoturno->estrelas or 0}} {{trans('hotel.estrelas')}}">
                            <span class="five-stars" style="width: {{$serviconoturno->estrelas * 20}}%;"></span>
                        </div>
                        <span class="review pull-right">{{$serviconoturno->estrelas or 0}} {{trans('hotel.estrelas')}}</span>
                    </div> -->
                        <!-- CARRINHO -->
                        <form action="{{URL::to('carrinho/add')}}" method="POST">
                            <input type="hidden" name="produto" value="{{$serviconoturno->id}}" />

                            @if($serviconoturno->tipo == 'Boate' || $serviconoturno->tipo == 'Evento')

                                <h3> {{trans('ingresso.masculino')}} </h3>
                                <table class="preco_m">
                                    <thead>
                                        <tr>
                                            <th>
                                                {{trans('ingresso.tipo')}}
                                            </th>
                                            <th>
                                                {{trans('ingresso.quantidade')}}
                                            </th>
                                            <th>
                                                {{trans('ingresso.preco')}}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                {{trans('ingresso.inteira')}}
                                            </td>
                                            <td>
                                                <input type="text" name="quantidade[masculino][inteira]" class="form-control" />
                                            </td>
                                            <td>
                                                {{$serviconoturno->valor_masculino}}
                                            </td>
                                        </tr>
                                        @if(Session::get('lang') == 'pt')
                                        <tr>
                                            <td>
                                                {{trans('ingresso.meia')}}
                                            </td>
                                            <td>
                                                <input type="text" name="quantidade[masculino][meia]" class="form-control" />
                                            </td>
                                            <td>
                                                {{$serviconoturno->valor_masculino_meia}}
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>

                                <h3> {{trans('ingresso.feminino')}} </h3>
                                <table class="preco_f">
                                    <thead>
                                        <tr>
                                            <th>
                                                {{trans('ingresso.tipo')}}
                                            </th>
                                            <th>
                                                {{trans('ingresso.quantidade')}}
                                            </th>
                                            <th>
                                                {{trans('ingresso.preco')}}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                {{trans('ingresso.inteira')}}
                                            </td>
                                            <td>
                                                <input type="text" name="quantidade[feminino][inteira]" class="form-control" />
                                            </td>
                                            <td>
                                                {{$serviconoturno->valor_feminino}}
                                            </td>
                                        </tr>
                                        @if(Session::get('lang') == 'pt')
                                        <tr>
                                            <td>
                                                {{trans('ingresso.meia')}}
                                            </td>
                                            <td>
                                                <input type="text" name="quantidade[feminino][meia]" class="form-control" />
                                            </td>
                                            <td>
                                                {{$serviconoturno->valor_feminino_meia}}
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>


                                <br />

                                <!-- <div class="row">
                                    <h3> Ingresso Masculino INTEIRA </h3>
                                    <div class="col-md-6">
                                        Quantidade
                                        <input type="text" name="quantidade_masculino" class="form-control" />
                                    </div>
                                    <div class="col-md-6">
                                        {{$serviconoturno->valor_masculino}}
                                    </div>
                                </div>
                                <div class="row">
                                    <h3> Ingresso Feminino INTEIRA </h3>
                                    <div class="col-md-6">
                                        Quantidade
                                        <input type="text" name="quantidade_feminino" class="form-control" />
                                    </div>
                                    <div class="col-md-6">
                                        {{$serviconoturno->valor_feminino}}
                                    </div>
                                </div>

                                <div class="row">
                                    <h3> Ingresso Masculino MEIA </h3>
                                    <div class="col-md-6">
                                        Quantidade
                                        <input type="text" name="quantidade_masculino_meia" class="form-control" />
                                    </div>
                                    <div class="col-md-6">
                                    <h3> Preço </h3>
                                        {{$serviconoturno->valor_masculino_meia}}
                                    </div>
                                </div>
                                <div class="row">
                                    <h3> Ingresso Feminino MEIA </h3>
                                    <div class="col-md-6">
                                        Quantidade
                                        <input type="text" name="quantidade_feminino_meia" class="form-control" />
                                    </div>
                                    <div class="col-md-6">
                                        {{$serviconoturno->valor_feminino_meia}}
                                    </div>
                                </div> -->
                            @endif

                            <!-- <button type="submit" class="button yellow full-width uppercase btn-small">{{trans('hotel.comprar')}}</button> -->

                            @include('forms.form_modal')
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