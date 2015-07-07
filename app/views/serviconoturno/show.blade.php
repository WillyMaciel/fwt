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
                    <!-- <li><a href="#hotel-availability" data-toggle="tab">Availability</a></li> -->
                    <!--li><a href="#hotel-amenities" data-toggle="tab">Amenities</a></li-->
                    <li><a href="#hotel-reviews" data-toggle="tab">Reviews</a></li>
                    <!--li><a href="#hotel-faqs" data-toggle="tab">FAQs</a></li-->
                    <!--li><a href="#hotel-things-todo" data-toggle="tab">Things to Do</a></li-->
                    <li><a href="#hotel-write-review" data-toggle="tab">Write a Review</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="hotel-description">
                        <div class="long-description">
                            <h2>@if(Session::get('lang') == 'pt') Sobre {{$serviconoturno->nome_br}} @else About {{$serviconoturno->nome_en}} @endif</h2>
                            <p>@if(Session::get('lang') == 'pt') {{$serviconoturno->descricao_br}} @else {{$serviconoturno->descricao_en}} @endif</p>
                        </div>
                    </div>
                    <!-- <div class="tab-pane fade" id="hotel-availability">
                        <div class="update-search clearfix">
                            <div class="col-md-5">
                                <h4 class="title">When</h4>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <label>CHECK IN</label>
                                        <div class="datepicker-wrap">
                                            <input type="text" placeholder="mm/dd/yy" class="input-text full-width" />
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <label>CHECK OUT</label>
                                        <div class="datepicker-wrap">
                                            <input type="text" placeholder="mm/dd/yy" class="input-text full-width" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <h4 class="title">Who</h4>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <label>ROOMS</label>
                                        <div class="selector">
                                            <select class="full-width">
                                                <option value="1">01</option>
                                                <option value="2">02</option>
                                                <option value="3">03</option>
                                                <option value="4">04</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <label>ADULTS</label>
                                        <div class="selector">
                                            <select class="full-width">
                                                <option value="1">01</option>
                                                <option value="2">02</option>
                                                <option value="3">03</option>
                                                <option value="4">04</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <label>KIDS</label>
                                        <div class="selector">
                                            <select class="full-width">
                                                <option value="1">01</option>
                                                <option value="2">02</option>
                                                <option value="3">03</option>
                                                <option value="4">04</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <h4 class="visible-md visible-lg">&nbsp;</h4>
                                <label class="visible-md visible-lg">&nbsp;</label>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <button data-animation-duration="1" data-animation-type="bounce" class="full-width icon-check animated" type="submit">SEARCH NOW</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h2>Available Rooms</h2>
                        <div class="room-list listing-style3 hotel">
                            <article class="box">
                                <figure class="col-sm-4 col-md-3">
                                    <a class="hover-effect popup-gallery" href="ajax/slideshow-popup.html" title=""><img width="230" height="160" src="http://placehold.it/230x160" alt=""></a>
                                </figure>
                                <div class="details col-xs-12 col-sm-8 col-md-9">
                                    <div>
                                        <div>
                                            <div class="box-title">
                                                <h4 class="title">Standard Family Room</h4>
                                                <dl class="description">
                                                    <dt>Max Guests:</dt>
                                                    <dd>3 persons</dd>
                                                </dl>
                                            </div>
                                            <div class="amenities">
                                                <i class="soap-icon-wifi circle"></i>
                                                <i class="soap-icon-fitnessfacility circle"></i>
                                                <i class="soap-icon-fork circle"></i>
                                                <i class="soap-icon-television circle"></i>
                                            </div>
                                        </div>
                                        <div class="price-section">
                                            <span class="price"><small>PER/NIGHT</small>$121</span>
                                        </div>
                                    </div>
                                    <div>
                                        <p>Nunc cursus libero purus ac congue ar lorem cursus ut sed vitae pulvinar massa idend porta nequetiam elerisque mi id, consectetur adipi deese cing elit maus fringilla bibe endum.</p>
                                        <div class="action-section">
                                            <a href="hotel-booking.html" title="" class="button btn-small full-width text-center">BOOK NOW</a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article class="box">
                                <figure class="col-sm-4 col-md-3">
                                    <a class="hover-effect popup-gallery" href="ajax/slideshow-popup.html" title=""><img width="230" height="160" src="http://placehold.it/230x160" alt=""></a>
                                </figure>
                                <div class="details col-xs-12 col-sm-8 col-md-9">
                                    <div>
                                        <div>
                                            <div class="box-title">
                                                <h4 class="title">Superior Double Room</h4>
                                                <dl class="description">
                                                    <dt>Max Guests:</dt>
                                                    <dd>5 persons</dd>
                                                </dl>
                                            </div>
                                            <div class="amenities">
                                                <i class="soap-icon-wifi circle"></i>
                                                <i class="soap-icon-fitnessfacility circle"></i>
                                                <i class="soap-icon-fork circle"></i>
                                                <i class="soap-icon-television circle"></i>
                                            </div>
                                        </div>
                                        <div class="price-section">
                                            <span class="price"><small>PER/NIGHT</small>$241</span>
                                        </div>
                                    </div>
                                    <div>
                                        <p>Nunc cursus libero purus ac congue ar lorem cursus ut sed vitae pulvinar massa idend porta nequetiam elerisque mi id, consectetur adipi deese cing elit maus fringilla bibe endum.</p>
                                        <div class="action-section">
                                            <a href="hotel-booking.html" title="" class="button btn-small full-width text-center">BOOK NOW</a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article class="box">
                                <figure class="col-sm-4 col-md-3">
                                    <a class="hover-effect popup-gallery" href="ajax/slideshow-popup.html" title=""><img width="230" height="160" src="http://placehold.it/230x160" alt=""></a>
                                </figure>
                                <div class="details col-xs-12 col-sm-8 col-md-9">
                                    <div>
                                        <div>
                                            <div class="box-title">
                                                <h4 class="title">Deluxe Single Room</h4>
                                                <dl class="description">
                                                    <dt>Max Guests:</dt>
                                                    <dd>4 persons</dd>
                                                </dl>
                                            </div>
                                            <div class="amenities">
                                                <i class="soap-icon-wifi circle"></i>
                                                <i class="soap-icon-fitnessfacility circle"></i>
                                                <i class="soap-icon-fork circle"></i>
                                                <i class="soap-icon-television circle"></i>
                                            </div>
                                        </div>
                                        <div class="price-section">
                                            <span class="price"><small>PER/NIGHT</small>$137</span>
                                        </div>
                                    </div>
                                    <div>
                                        <p>Nunc cursus libero purus ac congue ar lorem cursus ut sed vitae pulvinar massa idend porta nequetiam elerisque mi id, consectetur adipi deese cing elit maus fringilla bibe endum.</p>
                                        <div class="action-section">
                                            <a href="hotel-booking.html" title="" class="button btn-small full-width text-center">BOOK NOW</a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article class="box">
                                <figure class="col-sm-4 col-md-3">
                                    <a class="hover-effect popup-gallery" href="ajax/slideshow-popup.html" title=""><img width="230" height="160" src="http://placehold.it/230x160" alt=""></a>
                                </figure>
                                <div class="details col-xs-12 col-sm-8 col-md-9">
                                    <div>
                                        <div>
                                            <div class="box-title">
                                                <h4 class="title">Single Bed Room</h4>
                                                <dl class="description">
                                                    <dt>Max Guests:</dt>
                                                    <dd>2 persons</dd>
                                                </dl>
                                            </div>
                                            <div class="amenities">
                                                <i class="soap-icon-wifi circle"></i>
                                                <i class="soap-icon-fitnessfacility circle"></i>
                                                <i class="soap-icon-fork circle"></i>
                                                <i class="soap-icon-television circle"></i>
                                            </div>
                                        </div>
                                        <div class="price-section">
                                            <span class="price"><small>PER/NIGHT</small>$55</span>
                                        </div>
                                    </div>
                                    <div>
                                        <p>Nunc cursus libero purus ac congue ar lorem cursus ut sed vitae pulvinar massa idend porta nequetiam elerisque mi id, consectetur adipi deese cing elit maus fringilla bibe endum.</p>
                                        <div class="action-section">
                                            <a href="hotel-booking.html" title="" class="button btn-small full-width text-center">BOOK NOW</a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <a href="#" class="load-more button full-width btn-large fourty-space">LOAD MORE ROOMS</a>
                        </div>

                    </div> -->
                    <div class="tab-pane fade" id="hotel-amenities">
                        <h2>Amenities Style 01</h2>

                        <p>Maecenas vitae turpis condimentum metus tincidunt semper bibendum ut orci. Donec eget accumsan est. Duis laoreet sagittis elit et vehicula. Cras viverra posuere condimentum. Donec urna arcu, venenatis quis augue sit amet, mattis gravida nunc. Integer faucibus, tortor a tristique adipiscing, arcu metus luctus libero, nec vulputate risus elit id nibh.</p>
                        <ul class="amenities clearfix style1">
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style1"><i class="soap-icon-wifi"></i>WI_FI</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style1"><i class="soap-icon-swimming"></i>swimming pool</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style1"><i class="soap-icon-television"></i>television</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style1"><i class="soap-icon-coffee"></i>coffee</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style1"><i class="soap-icon-aircon"></i>air conditioning</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style1"><i class="soap-icon-fitnessfacility"></i>fitness facility</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style1"><i class="soap-icon-fridge"></i>fridge</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style1"><i class="soap-icon-winebar"></i>wine bar</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style1"><i class="soap-icon-smoking"></i>smoking allowed</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style1"><i class="soap-icon-entertainment"></i>entertainment</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style1"><i class="soap-icon-securevault"></i>secure vault</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style1"><i class="soap-icon-pickanddrop"></i>pick and drop</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style1"><i class="soap-icon-phone"></i>room service</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style1"><i class="soap-icon-pets"></i>pets allowed</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style1"><i class="soap-icon-playplace"></i>play place</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style1"><i class="soap-icon-breakfast"></i>complimentary breakfast</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style1"><i class="soap-icon-parking"></i>Free parking</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style1"><i class="soap-icon-conference"></i>conference room</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style1"><i class="soap-icon-fireplace"></i>fire place</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style1"><i class="soap-icon-handicapaccessiable"></i>Handicap Accessible</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style1"><i class="soap-icon-doorman"></i>Doorman</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style1"><i class="soap-icon-tub"></i>Hot Tub</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style1"><i class="soap-icon-elevator"></i>Elevator in Building</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style1"><i class="soap-icon-star"></i>Suitable for Events</div>
                            </li>
                        </ul>
                        <br />

                        <h2>Amenities Style 02</h2>
                        <p>Maecenas vitae turpis condimentum metus tincidunt semper bibendum ut orci. Donec eget accumsan est. Duis laoreet sagittis elit et vehicula. Cras viverra posuere condimentum. Donec urna arcu, venenatis quis augue sit amet, mattis gravida nunc. Integer faucibus, tortor a tristique adipiscing, arcu metus luctus libero, nec vulputate risus elit id nibh.</p>
                        <ul class="amenities clearfix style2">
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style2"><i class="soap-icon-wifi circle"></i>WI_FI</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style2"><i class="soap-icon-swimming circle"></i>swimming pool</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style2"><i class="soap-icon-television circle"></i>television</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style2"><i class="soap-icon-coffee circle"></i>coffee</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style2"><i class="soap-icon-aircon circle"></i>air conditioning</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style2"><i class="soap-icon-fitnessfacility circle"></i>fitness facility</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style2"><i class="soap-icon-fridge circle"></i>fridge</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style2"><i class="soap-icon-winebar circle"></i>wine bar</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style2"><i class="soap-icon-smoking circle"></i>smoking allowed</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style2"><i class="soap-icon-entertainment circle"></i>entertainment</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style2"><i class="soap-icon-securevault circle"></i>secure vault</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style2"><i class="soap-icon-pickanddrop circle"></i>pick and drop</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style2"><i class="soap-icon-phone circle"></i>room service</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style2"><i class="soap-icon-pets circle"></i>pets allowed</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style2"><i class="soap-icon-playplace circle"></i>play place</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style2"><i class="soap-icon-breakfast circle"></i>complimentary breakfast</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style2"><i class="soap-icon-parking circle"></i>Free parking</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style2"><i class="soap-icon-conference circle"></i>conference room</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style2"><i class="soap-icon-fireplace circle"></i>fire place</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style2"><i class="soap-icon-handicapaccessiable circle"></i>Handicap Accessible</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style2"><i class="soap-icon-doorman circle"></i>Doorman</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style2"><i class="soap-icon-tub circle"></i>Hot Tub</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style2"><i class="soap-icon-elevator circle"></i>Elevator in Building</div>
                            </li>
                            <li class="col-md-4 col-sm-6">
                                <div class="icon-box style2"><i class="soap-icon-star circle"></i>Suitable for Events</div>
                            </li>
                        </ul>
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
                    <div class="tab-pane fade" id="hotel-faqs">
                        <h2>Frquently Asked Questions</h2>
                        <div class="topics">
                            <ul class="check-square clearfix">
                                <li class="col-sm-6 col-md-4"><a href="#">address &amp; map</a></li>
                                <li class="col-sm-6 col-md-4"><a href="#">messaging</a></li>
                                <li class="col-sm-6 col-md-4"><a href="#">refunds</a></li>
                                <li class="col-sm-6 col-md-4"><a href="#">pricing</a></li>
                                <li class="col-sm-6 col-md-4 active"><a href="#">reservation requests</a></li>
                                <li class="col-sm-6 col-md-4"><a href="#">your reservation</a></li>
                            </ul>
                        </div>
                        <p>Maecenas vitae turpis condimentum metus tincidunt semper bibendum ut orci. Donec eget accumsan est. Duis laoreet sagittis elit et vehicula. Cras viverra posuere condimentum. Donec urna arcu, venenatis quis augue sit amet, mattis gravida nunc. Integer faucibus, tortor a tristique adipiscing, arcu metus luctus libero, nec vulputate risus elit id nibh.</p>
                        <div class="toggle-container">
                            <div class="panel style1 arrow-right">
                                <h4 class="panel-title">
                                    <a class="collapsed" href="#question1" data-toggle="collapse">How do I know a reservation is accepted or confirmed?</a>
                                </h4>
                                <div class="panel-collapse collapse" id="question1">
                                    <div class="panel-content">

                                    </div>
                                </div>
                            </div>
                            <div class="panel style1 arrow-right">
                                <h4 class="panel-title">
                                    <a class="collapsed" href="#question2" data-toggle="collapse">What do I do after I receive a reservation request from a guest?</a>
                                </h4>
                                <div class="panel-collapse collapse" id="question2">
                                    <div class="panel-content">
                                        <p>Sed a justo enim. Vivamus volutpat ipsum ultrices augue porta lacinia. Proin in elementum enim. <span class="skin-color">Duis suscipit justo</span> non purus consequat molestie. Etiam pharetra ipsum sagittis sollicitudin ultricies. Praesent luctus, diam ut tempus aliquam, diam ante euismod risus, euismod viverra quam quam eget turpis. Nam <span class="skin-color">tristique congue</span> arcu, id bibendum diam. Ut hendrerit, leo a pellentesque porttitor, purus arcu tristique erat, in faucibus elit leo in turpis vitae luctus enim, a mollis nulla.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel style1 arrow-right">
                                <h4 class="panel-title">
                                    <a class="" href="#question3" data-toggle="collapse">How much time do I have to respond to a reservation request?</a>
                                </h4>
                                <div class="panel-collapse collapse in" id="question3">
                                    <div class="panel-content">
                                        <p>Sed a justo enim. Vivamus volutpat ipsum ultrices augue porta lacinia. Proin in elementum enim. <span class="skin-color">Duis suscipit justo</span> non purus consequat molestie. Etiam pharetra ipsum sagittis sollicitudin ultricies. Praesent luctus, diam ut tempus aliquam, diam ante euismod risus, euismod viverra quam quam eget turpis. Nam <span class="skin-color">tristique congue</span> arcu, id bibendum diam. Ut hendrerit, leo a pellentesque porttitor, purus arcu tristique erat, in faucibus elit leo in turpis vitae luctus enim, a mollis nulla.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel style1 arrow-right">
                                <h4 class="panel-title">
                                    <a class="collapsed" href="#question4" data-toggle="collapse">Why can’t I call or email hotel or host before booking?</a>
                                </h4>
                                <div class="panel-collapse collapse" id="question4">
                                    <div class="panel-content">

                                    </div>
                                </div>
                            </div>
                            <div class="panel style1 arrow-right">
                                <h4 class="panel-title">
                                    <a class="collapsed" href="#question5" data-toggle="collapse">Am I allowed to decline reservation requests?</a>
                                </h4>
                                <div class="panel-collapse collapse" id="question5">
                                    <div class="panel-content">

                                    </div>
                                </div>
                            </div>
                            <div class="panel style1 arrow-right">
                                <h4 class="panel-title">
                                    <a class="collapsed" href="#question6" data-toggle="collapse">What happens if I let a reservation request expire?</a>
                                </h4>
                                <div class="panel-collapse collapse" id="question6">
                                    <div class="panel-content">

                                    </div>
                                </div>
                            </div>
                            <div class="panel style1 arrow-right">
                                <h4 class="panel-title">
                                    <a class="collapsed" href="#question7" data-toggle="collapse">How do I set reservation requirements?</a>
                                </h4>
                                <div class="panel-collapse collapse" id="question7">
                                    <div class="panel-content">

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="hotel-things-todo">
                        <h2>Things to Do</h2>
                        <p>Maecenas vitae turpis condimentum metus tincidunt semper bibendum ut orci. Donec eget accumsan est. Duis laoreet sagittis elit et vehicula. Cras viverra posuere condimentum. Donec urna arcu, venenatis quis augue sit amet, mattis gravida nunc. Integer faucibus, tortor a tristique adipiscing, arcu metus luctus libero, nec vulputate risus elit id nibh.</p>
                        <div class="activities image-box style2 innerstyle">
                            <article class="box">
                                <figure>
                                    <a title="" href="#"><img width="250" height="161" alt="" src="http://placehold.it/250x160"></a>
                                </figure>
                                <div class="details">
                                    <div class="details-header">
                                        <div class="review-score">
                                            <div class="five-stars-container"><div style="width: 60%;" class="five-stars"></div></div>
                                            <span class="reviews">25 reviews</span>
                                        </div>
                                        <h4 class="box-title">Central Park Walking Tour</h4>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat wisi enim don't look even slightly believable.</p>
                                    <a class="button" title="" href="#">MORE</a>
                                </div>
                            </article>
                            <article class="box">
                                <figure>
                                    <a title="" href="#"><img width="250" height="161" alt="" src="http://placehold.it/250x160"></a>
                                </figure>
                                <div class="details">
                                    <div class="details-header">
                                        <div class="review-score">
                                            <div class="five-stars-container"><div style="width: 60%;" class="five-stars"></div></div>
                                            <span class="reviews">25 reviews</span>
                                        </div>
                                        <h4 class="box-title">Museum of Modern Art</h4>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat wisi enim don't look even slightly believable.</p>
                                    <a class="button" title="" href="#">MORE</a>
                                </div>
                            </article>
                            <article class="box">
                                <figure>
                                    <a title="" href="#"><img width="250" height="161" alt="" src="http://placehold.it/250x160"></a>
                                </figure>
                                <div class="details">
                                    <div class="details-header">
                                        <div class="review-score">
                                            <div class="five-stars-container"><div style="width: 60%;" class="five-stars"></div></div>
                                            <span class="reviews">25 reviews</span>
                                        </div>
                                        <h4 class="box-title">Crazy Horse Cabaret Show</h4>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat wisi enim don't look even slightly believable.</p>
                                    <a class="button" title="" href="#">MORE</a>
                                </div>
                            </article>
                        </div>
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

                    <div class="feedback clearfix">
                        <div title="" class="five-stars-container" data-toggle="tooltip" data-placement="bottom" data-original-title="{{$serviconoturno->estrelas or 0}} {{trans('hotel.estrelas')}}">
                            <span class="five-stars" style="width: {{$serviconoturno->estrelas * 20}}%;"></span>
                        </div>
                        <span class="review pull-right">{{$serviconoturno->estrelas or 0}} {{trans('hotel.estrelas')}}</span>
                    </div>
                    <p class="description">@if(Session::get('lang') == 'pt') {{substr($serviconoturno->descricao_br, 0, 150) . ' ...'}} @else {{substr($serviconoturno->descricao_en, 0, 150) . ' ...'}} @endif</p>
                        <!-- CARRINHO -->
                        <form action="{{URL::to('carrinho/add')}}" method="POST">
                            <input type="hidden" name="produto" value="{{$serviconoturno->id}}" />

                            @if($serviconoturno->tipo == 'Boate')

                                <h3> Ingresso Masculino </h3>
                                <table class="preco_m">
                                    <thead>
                                        <tr>
                                            <th>
                                                Tipo
                                            </th>
                                            <th>
                                                Quantidade
                                            </th>
                                            <th>
                                                Preço
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                INTEIRA
                                            </td>
                                            <td>
                                                <input type="text" name="quantidade_masculino" class="form-control" />
                                            </td>
                                            <td>
                                                {{$serviconoturno->valor_masculino}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                MEIA
                                            </td>
                                            <td>
                                                <input type="text" name="quantidade_masculino_meia" class="form-control" />
                                            </td>
                                            <td>
                                                {{$serviconoturno->valor_masculino_meia}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <h3> Ingresso Feminino </h3>
                                <table class="preco_f">
                                    <thead>
                                        <tr>
                                            <th>
                                                Tipo
                                            </th>
                                            <th>
                                                Quantidade
                                            </th>
                                            <th>
                                                Preço
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                INTEIRA
                                            </td>
                                            <td>
                                                <input type="text" name="quantidade_masculino" class="form-control" />
                                            </td>
                                            <td>
                                                {{$serviconoturno->valor_feminino}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                MEIA
                                            </td>
                                            <td>
                                                <input type="text" name="quantidade_feminino_meia" class="form-control" />
                                            </td>
                                            <td>
                                                {{$serviconoturno->valor_feminino_meia}}
                                            </td>
                                        </tr>
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