@extends('templates.home')
@section('title')
<div class="page-title-container">
    <div class="container">
        <div class="page-title pull-left">
            <h2 class="entry-title">{{trans('orcamento.titulo')}}</h2>
        </div>
        <ul class="breadcrumbs pull-right">
            <li><a href="/">HOME</a></li>
            <li class="active">{{trans('menu.orcar')}}</li>
        </ul>
    </div>
</div>
@stop
@section('content')
<div class="container">
	<div class="row">
		@include('elements.alerts')
	    <div id="main" class="col-sms-12 col-sm-12 col-md-12">
	        <div class="booking-section travelo-box">
	            
	            <form class="booking-form" method="POST" action="{{URL::to('price')}}">
	                <div class="person-information">
	                    <h2>{{trans('orcamento.info_pessoal')}}</h2>
	                    <div class="form-group row">
	                        <div class="col-sm-6 col-md-6">
	                            <label>{{trans('orcamento.primeiro_nome')}}</label>
	                            <input name="firstname" type="text" class="input-text full-width" value="" placeholder="" />
	                        </div>
	                        <div class="col-sm-6 col-md-6">
	                            <label>{{trans('orcamento.ultimo_nome')}}</label>
	                            <input name="lastname" type="text" class="input-text full-width" value="" placeholder="" />
	                        </div>
	                    </div>
	                    <div class="form-group row">
	                        <div class="col-sm-12 col-md-12">
	                            <label>email address</label>
	                            <input name="email" type="email" class="input-text full-width" value="" placeholder="E-mail" />
	                        </div>
	                    </div>
	                    <div class="form-group row">
	                        <div class="col-sm-12 col-md-12">
	                            <label>{{trans('orcamento.telefone')}}</label>
	                            <input name="telefone" type="text" class="input-text full-width" value="" placeholder="{{trans('orcamento.telefone')}}" />
	                        </div>
	                    </div>
	                </div>
	                <hr />
	                <div class="card-information">
	                    <h2>{{trans('orcamento.onde_quer_ir')}}</h2>
	                    <div class="form-group row">
	                        <div class="col-sm-12 col-md-12">
	                            <label>{{trans('orcamento.tipo_de_ferias')}}</label>
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
	                            </div>
	                        </div>
	                    </div>
	                    <div class="form-group row">
	                        <div class="col-sm-12 col-md-12">
	                            <label>{{trans('orcamento.customize_viagem')}}</label>
	                            <textarea name="customize_trip" rows="8" class="input-text full-width" placeholder="{{trans('orcamento.customize_viagem')}}"></textarea>
	                        </div>
	                    </div>
	                </div>
	                <hr />

	                <!-- WHEN AND WITH WHO -->
	                <div class="person-information">
	                    <h2>{{trans('orcamento.onde_e_com_quem')}}</h2>
	                    <div class="form-group row">
	                        <div class="col-sm-6 col-md-6">
	                            <label>{{trans('orcamento.num_de_viajantes')}}</label>
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
	                        <div class="col-sm-6 col-md-6">
	                            <label>{{trans('orcamento.num_por_quartos')}}</label>
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
	                    <div class="form-group row">
	                        <div class="col-sm-6 col-md-6">
	                            <label>{{trans('orcamento.cidade_partida')}}</label>
	                            <input name="departure_city" type="text" class="input-text full-width" placeholder="{{trans('orcamento.cidade_partida')}} (EX: Rio de Janeiro)" />
	                        </div>
	                        <div class="col-sm-6 col-md-6">
	                            <label>{{trans('orcamento.data_partida')}}</label>
	                            <div class="datepicker-wrap">
                                    <input name="departure_date" type="text" class="input-text full-width" placeholder="{{trans('orcamento.data_partida')}}" />
                                </div>
	                        </div>
	                    </div>
	                    <div class="form-group row">
	                        <div class="col-sm-6 col-md-6">
	                            <label>{{trans('orcamento.num_noites')}}</label>
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
	                        <div class="col-sm-6 col-md-6">
	                            <label>{{trans('orcamento.num_festas_clubes')}}</label>
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
	                <hr />

	                <!-- YOUR BUGDET -->
	                <div class="person-information">
	                    <h2>{{trans('orcamento.seu_orcamento')}}</h2>
	                    <div class="form-group row">
	                        <div class="col-sm-4 col-md-4">
	                            <label>{{trans('orcamento.datas_flexiveis')}}</label>
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
	                        <div class="col-sm-4 col-md-4">
	                            <label>{{trans('orcamento.orcamento_em')}} U.S. $:</label>
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
	                        <div class="col-sm-4 col-md-4">
	                            <label>{{trans('orcamento.nivel_acomodacao')}}</label>
	                            <div class="selector">
	                                <select name="nivel_acomodacao" class="full-width">
	                                    <option value="Budget">{{trans('orcamento.dentro_orcamento')}}</option>
									    <option value="3 Stars">3 {{trans('orcamento.estrelas')}}</option>
									    <option value="4 Stars">4 {{trans('orcamento.estrelas')}}</option>
									    <option value="5 Stars">5 {{trans('orcamento.estrelas')}}</option>
	                                </select>
	                                <span class="custom-select full-width">{{trans('orcamento.nivel_acomodacao')}}</span>
	                            </div>
	                        </div>
	                    </div>

	                    <div class="form-group row">
	                        <div class="col-sm-4 col-md-4">
	                            <label>{{trans('orcamento.detalhe_acomodacao')}}</label>
                            	<textarea name="acomodation_details" rows="8" class="input-text full-width" placeholder="{{trans('orcamento.detalhe_acomodacao')}}"></textarea>
	                        </div>
	                        <div class="col-sm-4 col-md-4">
	                            <label>{{trans('orcamento.share_info_group')}}</label>
	                            <textarea name="desired_experience" rows="8" class="input-text full-width" placeholder="{{trans('orcamento.share_info_group')}}"></textarea>
	                        </div>
	                        <div class="col-sm-4 col-md-4">
	                            <label>{{trans('orcamento.como_nos_conheceu')}}</label>
	                            <textarea name="hear_about_us" rows="8" class="input-text full-width" placeholder="{{trans('orcamento.como_nos_conheceu')}}"></textarea>
                        	</div>
	                    </div>                    
	                </div>
	                <hr />

	                <!-- <div class="form-group">
	                    <div class="checkbox">
	                        <label>
	                            <input type="checkbox"> By continuing, you agree to the <a href="#"><span class="skin-color">Terms and Conditions</span></a>.
	                        </label>
	                    </div>
	                </div> -->
	                <div class="form-group row">
	                    <div class="col-sm-6 col-md-5">
	                        <button type="submit" class="full-width btn-large">{{trans('orcamento.enviar')}}</button>
	                    </div>
	                </div>
	            </form>
	        </div>
	    </div>
	    <!-- <div class="sidebar col-sms-6 col-sm-4 col-md-3">
	        <div class="booking-details travelo-box">
	            <h4>Booking Details</h4>
	            <article class="flight-booking-details">
	                <figure class="clearfix">
	                    <a title="" href="flight-detailed.html" class="middle-block"><img class="middle-item" alt="" src="http://placehold.it/75x75"></a>
	                    <div class="travel-title">
	                        <h5 class="box-title">Indianapolis to paris<small>Oneway flight</small></h5>
	                        <a href="flight-detailed.html" class="button">EDIT</a>
	                    </div>
	                </figure>
	                <div class="details">
	                    <div class="constant-column-3 timing clearfix">
	                        <div class="check-in">
	                            <label>Take off</label>
	                            <span>NOV 30, 2013<br />7:50 am</span>
	                        </div>
	                        <div class="duration text-center">
	                            <i class="soap-icon-clock"></i>
	                            <span>13h, 40m</span>
	                        </div>
	                        <div class="check-out">
	                            <label>landing</label>
	                            <span>Nov 13 2013<br />9:20 am</span>
	                        </div>
	                    </div>
	                </div>
	            </article>
	            
	            <h4>Other Details</h4>
	            <dl class="other-details">
	                <dt class="feature">Airline:</dt><dd class="value">Delta</dd>
	                <dt class="feature">Flight type:</dt><dd class="value">Economy</dd>
	                <dt class="feature">base fare:</dt><dd class="value">$320</dd>
	                <dt class="feature">taxes and fees:</dt><dd class="value">$300</dd>
	                <dt class="total-price">Total Price</dt><dd class="total-price-value">$620</dd>
	            </dl>
	        </div>
	        
	        <div class="travelo-box contact-box">
	            <h4>Need Travelo Help?</h4>
	            <p>We would be more than happy to help you. Our team advisor are 24/7 at your service to help you.</p>
	            <address class="contact-details">
	                <span class="contact-phone"><i class="soap-icon-phone"></i> 1-800-123-HELLO</span>
	                <br>
	                <a class="contact-email" href="#">help@travelo.com</a>
	            </address>
	        </div>
	    </div> -->
	</div>
</div>
@stop