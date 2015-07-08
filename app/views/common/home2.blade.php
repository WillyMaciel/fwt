@extends('templates.home2')

@section('content')

@include('elements.alerts')

<section id="content" class="slideshow-bg">
	<div id="slideshow">
	    <div class="flexslider">
	        <ul class="slides">
	            <li>
	                <div class="slidebg" style="background-image: url('images/slider/rio.jpg');"></div>
	            </li>
	            <li>
	                <div class="slidebg" style="background-image: url('images/slider/newyork.jpg');"></div>
	            </li>
	        </ul>
	    </div>
	</div>
	<div class="container">
	    <div id="main">
	        <h1 class="page-title">{{trans('orcamento.titulo')}}</h1>
	        <h2 class="page-description col-md-6 no-float no-padding">{{trans('orcamento.desc')}}</h2>
	        <div class="search-box-wrapper style2">
	        <form method="POST" action="{{URL::to('price')}}" style="width: 100%;">
	            <div class="search-box">
	                <ul class="search-tabs clearfix">
	                    <li class="active"><a href="#hotels-tab" data-toggle="tab"><i class="soap-icon-hotel"></i><span>{{trans('orcamento.passo')}} 1</span></a></li>
	                    <li><a href="#flights-tab" data-toggle="tab"><i class="soap-icon-plane-right takeoff-effect"></i><span>{{trans('orcamento.passo')}} 2</span></a></li>
	                    <li><a href="#flight-and-hotel-tab" data-toggle="tab"><i class="soap-icon-flight-hotel"></i><span>{{trans('orcamento.passo')}} 3</span></a></li>
	                    <li class="advanced-search visible-lg"><a href="#cars-tab" data-toggle="tab"><i class="soap-icon-car"></i><span>{{trans('orcamento.passo')}} 4</span></a></li>
	                </ul>
	                <div class="visible-mobile">
	                    <ul id="mobile-search-tabs" class="search-tabs clearfix">
	                        <li class="active"><a href="#hotels-tab">Step 1</a></li>
	                        <li><a href="#flights-tab">Step 2</a></li>
	                        <li><a href="#flight-and-hotel-tab">Step 3</a></li>
	                        <li class="advanced-search visible-lg"><a href="#cars-tab">Step 4</a></li>
	                    </ul>
	                </div>

	                <div class="search-tab-content">
	                    <div class="tab-pane fade active in" id="hotels-tab">
	                            <h4 class="title">{{trans('orcamento.info_pessoal')}}</h4>
	                            <div class="row">
	                                <div class="form-group col-sm-6 col-md-6">
	                                    <input name="firstname" type="text" class="input-text full-width" placeholder="{{trans('orcamento.primeiro_nome')}}" />
	                                </div>
	                                <div class="form-group col-sm-6 col-md-6">
	                                    <div class="row">
	                                        <div class="col-xs-4">
	                                        	<input name="lastname" type="text" class="input-text full-width" placeholder="{{trans('orcamento.ultimo_nome')}}" />
	                                        </div>
	                                        <div class="col-xs-4">
	                                        	<input name="telefone" type="text" class="input-text full-width" placeholder="{{trans('orcamento.telefone')}}" />
	                                        </div>
	                                        <div class="col-xs-4">
	                                        	<input name="email" type="text" class="input-text full-width" placeholder="E-mail" />
	                                        </div>
	                                    </div>
	                                </div>

	                            </div>
	                    </div>
	                    <div class="tab-pane fade" id="flights-tab">
	                            <h4 class="title">{{trans('orcamento.onde_quer_ir')}}</h4>
	                            <div class="row">
	                                <div class="col-md-12">
	                                    <div class="form-group">
	                                        <div class="selector">
                                                <select name="tipo_ferias" class="full-width">
                                                    <option value="Amazon Adventure Package">Amazon Adventure Package</option>
												    <option value="Best of Argentina Package">Best of Argentina Package</option>
												    <option value="Best of Brazil Package">Best of Brazil Package</option>
												    <option value="Best of South America">Best of South America</option>
												    <option value="Buenos Aires Package">Buenos Aires Package</option>
												    <option value="Carnival in Rio">Carnival in Rio</option>
												    <option value="Carnival in Salvador-Bahia">Carnival in Salvador-Bahia</option>
												    <option value="Cartagena Vacation Package">Cartagena Vacation Package</option>
												    <option value="Formula 1 - Brazil GP Sao Paulo">Formula 1 - Brazil GP Sao Paulo</option>
												    <option value="Florianopolis Vacation Package">Florianopolis Vacation Package</option>
												    <option value="Greek Island Package">Greek Island Package</option>
												    <option value="Ibiza Summer Package">Ibiza Summer Package</option>
												    <option value="Ibiza Rock Star Package">Ibiza Rock Star Package</option>
												    <option value="Iguazu Falls Package">Iguazu Falls Package</option>
												    <option value="La Tomatina">La Tomatina</option>
												    <option value="Miami - South Beach">Miami - South Beach</option>
												    <option value="New Years in Rio de Janeiro">New Years in Rio de Janeiro</option>
												    <option value="Oktoberfest - Munich">Oktoberfest - Munich</option>
												    <option value="Pamplona - Running of the Bulls">Pamplona - Running of the Bulls</option>
												    <option value="Peru Vacation Package">Peru Vacation Package</option>
												    <option value="Punta del Este">Punta del Este</option>
												    <option value="Rio de Janeiro Package">Rio de Janeiro Package</option>
												    <option value="Rio/Buenos Aires Package">Rio/Buenos Aires Package</option>
												    <option value="Rio de Janeiro plus Buzios">Rio de Janeiro plus Buzios</option>
												    <option value="Rio Summer Games 2016">Rio Summer Games 2016</option>
												    <option value="Tomorrowland Brasil">Tomorrowland Brasil</option>
												    <option value="Ultimate Carnival (Bahia and Rio)">Ultimate Carnival (Bahia and Rio)</option>
												    <option value="Ultimate Euro Party Tour">Ultimate Euro Party Tour</option>
												    <option value="Other (Be Specific Below)">Other (Be Specific Below)</option>
                                                </select>
                                                <!-- <span class="custom-select full-width">anytime</span> -->
                                            </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="row">
	                            	<div class="col-md-12">
	                                    <div class="form-group">
	                                    	<textarea name="customize_trip" rows="8" class="input-text full-width" placeholder="{{trans('orcamento.customize_viagem')}}"></textarea>
	                                    </div>
	                                </div>
	                            </div>
	                    </div>
	                    <div class="tab-pane fade" id="flight-and-hotel-tab">
	                            <h4 class="title">{{trans('orcamento.onde_e_com_quem')}}</h4>
	                            <div class="row">
	                                <div class="col-md-4">
	                                    <div class="form-group">
	                                        <div class="selector">
                                                <select name="number_of_travelers" class="full-width">
	                                                <option value="1">1</option>
												    <option value="2">2</option>
												    <option value="3">3</option>
												    <option value="4">4</option>
												    <option value="5">5</option>
												    <option value="6">6</option>
												    <option value="7">7</option>
												    <option value="8">8</option>
												    <option value="9">9</option>
												    <option value="10">10</option>
												    <option value="11">11</option>
												    <option value="12">12</option>
												    <option value="13">13</option>
												    <option value="14">14</option>
												    <option value="15">15</option>
												    <option value="16">16</option>
												    <option value="17">17</option>
												    <option value="18">18</option>
												    <option value="19">19</option>
												    <option value="20+">20+</option>
                                                </select>
                                                <span class="custom-select full-width">{{trans('orcamento.num_de_viajantes')}}</span>
                                            </div>
	                                    </div>
	                                    <div class="form-group">
	                                        <div class="selector">
                                                <select name="people_per_room" class="full-width">
	                                                <option value="1">1</option>
												    <option value="2">2</option>
												    <option value="3">3</option>
                                                </select>
                                                <span class="custom-select full-width">{{trans('orcamento.num_por_quartos')}}</span>
                                            </div>
	                                    </div>
	                                </div>

	                                <div class="col-md-4">
	                                    <div class="form-group row">
	                                        <div class="col-xs-12">
	                                        	<input name="departure_city" type="text" class="input-text full-width" placeholder="{{trans('orcamento.cidade_partida')}}" />
	                                        </div>
	                                    </div>
	                                    <div class="form-group row">
	                                        <div class="col-xs-12">
	                                            <div class="datepicker-wrap">
	                                                <input name="departure_date" type="text" class="input-text full-width" placeholder="{{trans('orcamento.data_partida')}}" />
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>

	                                <div class="col-md-4">
	                                    <div class="form-group row">
	                                        <div class="col-xs-12">
	                                            <div class="selector">
	                                                <select name="number_of_nights" class="full-width">
	                                                    <option value="1">1</option>
													    <option value="2">2</option>
													    <option value="3">3</option>
													    <option value="4">4</option>
													    <option value="5">5</option>
													    <option value="6">6</option>
													    <option value="7">7</option>
													    <option value="8">8</option>
													    <option value="9">9</option>
													    <option value="10">10</option>
													    <option value="11">11</option>
													    <option value="12">12</option>
													    <option value="13">13</option>
													    <option value="14">14</option>
													    <option value="15">15</option>
	                                                </select>
	                                                <span class="custom-select full-width">{{trans('orcamento.num_noites')}}</span>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="form-group row">
	                                        <div class="col-xs-12">
	                                            <div class="selector">
	                                                <select name="number_of_party_club_nights" class="full-width">
	                                                	<option value="0">0</option>
	                                                    <option value="1">1</option>
													    <option value="2">2</option>
													    <option value="3">3</option>
													    <option value="4">4</option>
													    <option value="5">5</option>
													    <option value="6">6</option>
													    <option value="7">7</option>
													    <option value="8">8</option>
													    <option value="9">9</option>
													    <option value="10">10</option>
													    <option value="11">11</option>
													    <option value="12">12</option>
													    <option value="13">13</option>
													    <option value="14">14</option>
													    <option value="15">15</option>
	                                                </select>
	                                                <span class="custom-select full-width">{{trans('orcamento.num_festas_clubes')}}</span>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                    </div>
	                    <div class="tab-pane fade" id="cars-tab">
	                            <h4 class="title">{{trans('orcamento.seu_orcamento')}}</h4>
	                            <div class="row">
	                                <div class="col-md-4">
	                                    <div class="form-group">
	                                        <div class="selector">
                                                <select name="flexible_dates" class="full-width">
	                                                <option value="Yes, 2 to 3 Days">Yes, 2 to 3 Days</option>
												    <option value="Yes, 4 to 7 Days">Yes, 4 to 7 Days</option>
												    <option value="Yes, Best Deal Possible">Yes, Best Deal Possible</option>
												    <option value="No, Exact Dates">No, Exact Dates</option>
                                                </select>
                                                <span class="custom-select full-width">{{trans('orcamento.datas_flexiveis')}}</span>
                                            </div>
	                                    </div>
	                                </div>

	                                <div class="col-md-4">
	                                	<div class="form-group">
	                                        <div class="selector">
                                                <select name="budget_us" class="full-width">
	                                                <option value="$1500 - $2000">$1500 - $2000</option>
												    <option value="$2000 - $2500">$2000 - $2500</option>
												    <option value="$2500 - $3000">$2500 - $3000</option>
												    <option value="$3000+">$3000+</option>
                                                </select>
                                                <span class="custom-select full-width">{{trans('orcamento.orcamento_em')}} U.S. $:</span>
                                            </div>
	                                    </div>
	                                </div>

	                                <div class="col-md-4">
	                                    <div class="form-group">
	                                        <div class="col-xs-12">
	                                        	<div class="selector">
	                                                <select name="nivel_acomodacao" class="full-width">
		                                                <option value="Budget">Budget</option>
													    <option value="3 Stars">3 Stars</option>
													    <option value="4 Stars">4 Stars</option>
													    <option value="5 Stars">5 Stars</option>
	                                                </select>
	                                                <span class="custom-select full-width">{{trans('orcamento.nivel_acomodacao')}}</span>
                                            	</div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>

	                            <div class="row">
	                            	<div class="col-md-4">
	                            		<div class="form-group">
	                                    	<textarea name="acomodation_details" rows="8" class="input-text full-width" placeholder="{{trans('orcamento.detalhe_acomodacao')}}"></textarea>
	                                    </div>
	                            	</div>

	                            	<div class="col-md-4">
	                            		<div class="form-group">
	                                    	<textarea name="desired_experience" rows="8" class="input-text full-width" placeholder="{{trans('orcamento.share_info_group')}}"></textarea>
	                                    </div>
	                            	</div>
	                            	<div class="col-md-4">
	                            		<div class="form-group">
	                                    	<textarea name="hear_about_us" rows="8" class="input-text full-width" placeholder="{{trans('orcamento.como_nos_conheceu')}}"></textarea>
	                                    	<div class="col-xs-6">
	                                            <button type="submit" class="full-width">{{trans('orcamento.enviar')}}</button>
	                                        </div>
	                                    </div>
	                            	</div>
	                            </div>
	                    </div>
	                </div>
	            </div>
	        </form>
	        </div>
	    </div>
	</div>
	<!-- <div class="featured image-box">
	    <div class="details pull-left">
	        <h3>Tropical Beach,<br/>Hotel and Resorts</h3>
	        <h5>THAILAND</h5>
	    </div>
	    <figure class="pull-left">
	        <a class="badge-container" href="{{URL::to('hotel')}}">
	            <span class="badge-content right-side">From $200</span>
	            <img width="64" height="64" alt="" src="http://placehold.it/64x64" class="">
	        </a>
	    </figure>
	</div> -->
	</section>

	<section>
		<div class="section container">
            <h3 class="specialeventstab"> <a href="{{trans('eventoespecial')}}"> {{trans('menu.eventos_especiais')}} </a>
                            </h3>
                <div class="row image-box style4">
                    <div class="col-sm-4">
                        <article class="box animated" data-animation-type="fadeInLeft" data-animation-delay="0">
                            <figure>
                                <a title="" href="{{trans('eventoespecial?tipo=Honeymoon')}}" class="hover-effect"><img width="370" height="172" alt="" img src= "images/honeymoon.jpg"></a>
                            </figure>
                            <div class="details">
                                <h4 class="box-title">{{trans('menu.lua_de_mel')}}</h4>
                                <a class="goto-detail" href="{{trans('eventoespecial?tipo=Honeymoon')}}"><span class="glyphicon glyphicon-arrow-right"></span></a>
                            </div>
                        </article>
                    </div>


                                       <div class="col-sm-4">
                        <article class="box animated" data-animation-type="fadeInLeft" data-animation-delay="0.6">
                            <figure>
                                <a title="" href="{{trans('eventoespecial?tipo=Bachelor')}}" class="hover-effect"><img width="370" height="172" alt="" img src= "images/bachelor.jpg"></a>
                            </figure>
                            <div class="details">
                                <h4 class="box-title">{{trans('menu.despedida_solteiro')}}</h4>
                                <a class="goto-detail" href="{{trans('eventoespecial?tipo=Bachelor')}}"><span class="glyphicon glyphicon-arrow-right"></span></a>
                            </div>
                        </article>
                    </div>


                    <div class="col-sm-4">
                        <article class="box animated" data-animation-type="fadeInLeft" data-animation-delay="0.3">
                            <figure>
                                <a title="" href="{{trans('eventoespecial?tipo=GayFriendly')}}" class="hover-effect"><img width="370" height="172" alt="" img src= "images/gayfriendly.jpg";></a>
                            </figure>
                            <div class="details">
                                <h4 class="box-title">{{trans('menu.gay_friendly')}}</h4>
                                <a class="goto-detail" href="{{trans('eventoespecial?tipo=GayFriendly')}}"><span class="glyphicon glyphicon-arrow-right"></span></a>
                            </div>
                        </article>
                    </div>

                </div>
            </div>

            <div class="global-map-area section parallax" data-stellar-background-ratio="0.5">
                <div class="container">
                    <div class="description text-center">
                        <h1>Popular Destinations</h1>
                    </div>
                    <div class="image-carousel style3 flex-slider" data-item-width="170" data-item-margin="30">
                        <ul class="slides image-box style9">
                        	@foreach($populares as $produto)
                            <li>
                                <article class="box">
                                    <figure>
                                        <a href="{{URL::to(strtolower($produto->class_name) . "/show/$produto->id")}}" title="" class="hover-effect yellow">
                                        	<img src="{{$produto->imagens->first()->caminho or 'images/'}}{{$produto->imagens->first()->nome or 'no-img.png'}}" alt="" style="width: 220px; height: 180px;" />
                                        </a>
                                    </figure>
                                    <div class="details">
                                        <h4 class="box-title">@if(Session::get('lang') == 'pt') {{$produto->nome_br}} @else {{$produto->nome_en}} @endif<small>({{$produto->visitas}} Hits)</small></h4>
                                        <a href="{{URL::to(strtolower($produto->class_name) . "/show/$produto->id")}}" title="" class="button">MORE</a>
                                    </div>
                                </article>
                            </li>
                            @endforeach
                            <!-- <li>
                                <article class="box">
                                    <figure>
                                        <a href="hotel-list-view.html" title="" class="hover-effect yellow"><img src="images/tenerife.jpg" alt="" width="170" height="160" /></a>
                                    </figure>
                                    <div class="details">
                                        <h4 class="box-title">Tenerife<small>(524 reviews)</small></h4>
                                        <a href="hotel-list-view.html" title="" class="button">MORE</a>
                                    </div>
                                </article>
                            </li>
                            <li>
                                <article class="box">
                                    <figure>
                                        <a href="hotel-list-view.html" title="" class="hover-effect yellow"><img src="images/riodejaneiro.jpg" alt="" width="170" height="160" /></a>
                                    </figure>
                                    <div class="details">
                                        <h4 class="box-title">Rio de Janeiro<small>(24 reviews)</small></h4>
                                        <a href="hotel-list-view.html" title="" class="button">MORE</a>
                                    </div>
                                </article>
                            </li>
                            <li>
                                <article class="box">
                                    <figure>
                                        <a href="hotel-list-view.html" title="" class="hover-effect yellow"><img src="images/buenosaires.jpg" alt="" width="170" height="160" /></a>
                                    </figure>
                                    <div class="details">
                                        <h4 class="box-title">Buenos Aires<small>(12 reviews)</small></h4>
                                        <a href="hotel-list-view.html" title="" class="button">MORE</a>
                                    </div>
                                </article>
                            </li>
                            <li>
                                <article class="box">
                                    <figure>
                                        <a href="hotel-list-view.html" title="" class="hover-effect yellow"><img src="images/newyork.jpg" alt="" width="170" height="160" /></a>
                                    </figure>
                                    <div class="details">
                                        <h4 class="box-title">New York<small>(34 reviews)</small></h4>
                                        <a href="hotel-list-view.html" title="" class="button">MORE</a>
                                    </div>
                                </article>
                            </li>
                            <li>
                                <article class="box">
                                    <figure>
                                        <a href="hotel-list-view.html" title="" class="hover-effect yellow"><img src="images/ibiza.jpg" alt="" width="170" height="160" /></a>
                                    </figure>
                                    <div class="details">
                                        <h4 class="box-title">Ibiza<small>(64 reviews)</small></h4>
                                        <a href="hotel-list-view.html" title="" class="button">MORE</a>
                                    </div>
                                </article>
                            </li>
                            <li>
                                <article class="box">
                                    <figure>
                                        <a href="hotel-list-view.html" title="" class="hover-effect yellow"><img src="images/londres.jpg" alt="" width="170" height="160" /></a>
                                    </figure>
                                    <div class="details">
                                        <h4 class="box-title">Londres<small>(54 reviews)</small></h4>
                                        <a href="hotel-list-view.html" title="" class="button">MORE</a>
                                    </div>
                                </article>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </div>

            <div class="container section">
                <h2> <a href="{{URL::to('serviconoturno')}}"> {{trans('menu.servicos_noturnos')}} </a> </h2>
                <div class="row image-box style10">
                    <div class="col-sms-6 col-sm-6 col-md-4">
                        <article class="box">
                            <figure class="animated" data-animation-type="fadeInDown" data-animation-duration="2">
                                <a href="{{URL::to('serviconoturno?tipo=Restaurante')}}" title="" class="hover-effect"><img src="images/pachabuzios.jpg" alt="" width="270" height="160" /></a>
                            </figure>
                            <div class="details">
                                <a href="{{URL::to('serviconoturno?tipo=Restaurante')}}" class="button btn-mini">SEE ALL</a>
                                <h4 class="box-title">{{trans('menu.restaurantes')}}<small>(780 visitors)</small></h4>
                            </div>
                        </article>
                    </div>
                    <div class="col-sms-6 col-sm-6 col-md-4">
                        <article class="box">
                            <figure class="animated" data-animation-type="fadeInDown" data-animation-duration="2">
                                <a href="{{URL::to('serviconoturno?tipo=Evento')}}" title="" class="hover-effect"><img src="images/tomorowland.jpg" alt="" width="270" height="160" /></a>
                            </figure>
                            <div class="details">
                                <a href="{{URL::to('serviconoturno?tipo=Evento')}}" class="button btn-mini">SEE ALL</a>
                                <h4 class="box-title">{{trans('menu.eventos')}}<small>(690 visitors)</small></h4>
                            </div>
                        </article>
                    </div>
                    <div class="col-sms-6 col-sm-6 col-md-4">
                        <article class="box">
                            <figure class="animated" data-animation-type="fadeInDown" data-animation-duration="2">
                                <a href="{{URL::to('serviconoturno?tipo=Boate')}}" title="" class="hover-effect"><img src="images/circovoador.jpg" alt="" width="270" height="160" /></a>
                            </figure>
                            <div class="details">
                                <a href="{{URL::to('serviconoturno?tipo=Boate')}}" class="button btn-mini">SEE ALL</a>
                                <h4 class="box-title">{{trans('menu.boates')}}<small>(920 visitors)</small></h4>
                            </div>
                        </article>
                    </div>
                </div>
            </div>

            <div class="global-map-area section parallax" data-stellar-background-ratio="0.5">

            	<div class="container">
	                <h1 class="specialeventstab"> <a href="{{trans('pacote-destaque')}}" style="color: white;"> {{trans('menu.pacote_destaque')}} </a>
	                            </h1>
	                <div class="row image-box style4">
	                    <div class="col-sm-4">
	                        <article class="box animated" data-animation-type="fadeInLeft" data-animation-delay="0">
	                            <figure>
	                                <a title="" href="{{URL::to('pacote-destaque?tipo=Honeymoon')}}" class="hover-effect"><img width="370" height="172" alt="" img src= "images/honeymoon.jpg"></a>
	                            </figure>
	                            <div class="details">
	                                <h4 class="box-title">{{trans('menu.lua_de_mel')}}</h4>
	                                <a class="goto-detail" href="{{URL::to('pacote-destaque?tipo=Honeymoon')}}"><span class="glyphicon glyphicon-arrow-right"></span></a>
	                            </div>
	                        </article>
	                    </div>


	                                       <div class="col-sm-4">
	                        <article class="box animated" data-animation-type="fadeInLeft" data-animation-delay="0.6">
	                            <figure>
	                                <a title="" href="{{trans('pacote-destaque?tipo=Bachelor')}}" class="hover-effect"><img width="370" height="172" alt="" img src= "images/bachelor.jpg"></a>
	                            </figure>
	                            <div class="details">
	                                <h4 class="box-title">{{trans('menu.despedida_solteiro')}}</h4>
	                                <a class="goto-detail" href="{{URL::to('pacote-destaque?tipo=Bachelor')}}"><span class="glyphicon glyphicon-arrow-right"></span></a>
	                            </div>
	                        </article>
	                    </div>


	                    <div class="col-sm-4">
	                        <article class="box animated" data-animation-type="fadeInLeft" data-animation-delay="0.3">
	                            <figure>
	                                <a title="" href="{{URL::to('pacote-destaque?tipo=GayFriendly')}}" class="hover-effect"><img width="370" height="172" alt="" img src= "images/gayfriendly.jpg";></a>
	                            </figure>
	                            <div class="details">
	                                <h4 class="box-title">{{trans('menu.gay_friendly')}}</h4>
	                                <a class="goto-detail" href="{{URL::to('pacote-destaque?tipo=GayFriendly')}}"><span class="glyphicon glyphicon-arrow-right"></span></a>
	                            </div>
	                        </article>
	                    </div>

	                </div>
	            </div>
            </div>
	</section>

@stop