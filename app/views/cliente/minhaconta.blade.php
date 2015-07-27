@extends('templates.blank')
@section('content')
<div class="page-title-container">
    <div class="container">
        <div class="page-title pull-left">
            <h2 class="entry-title">{{trans('cliente.minhaconta_title')}}</h2>
        </div>
    </div>
</div>


<section id="content" class="gray-area">
    <div class="container">
        @include('elements.alerts')
        <div id="main">
            <div class="tab-container full-width-style arrow-left dashboard">
                <ul class="tabs">
                    <li class="active"><a data-toggle="tab" href="#dashboard"><i class="soap-icon-anchor circle"></i>Dashboard</a></li>
                    <li class=""><a data-toggle="tab" href="#profile"><i class="soap-icon-user circle"></i>{{trans('minhaconta.profile')}}</a></li>
                    <!-- <li class=""><a data-toggle="tab" href="#travel-stories"><i class="soap-icon-conference circle"></i>Reviews</a></li> -->
                    <li class=""><a data-toggle="tab" href="#settings"><i class="soap-icon-settings circle"></i>{{trans('minhaconta.settings')}}</a></li>
                </ul>
                <div class="tab-content">
                    <div id="dashboard" class="tab-pane fade in active">
                        <h1 class="no-margin skin-color">{{trans('minhaconta.hi')}} {{Auth::user()->nome}}, {{trans('minhaconta.welcome')}}</h1>
                        <p>{{trans('minhaconta.alltrips')}}</p>
                        <br />
                        <div class="row block">
                            <!-- <div class="col-sm-6 col-md-3">
                                <a href="{{URL::to('hotel')}}">
                                    <div class="fact blue">
                                        <div class="numbers counters-box">
                                            <dl>
                                                <dt class="display-counter" data-value="{{$hotels}}">0</dt>
                                                <dd>{{trans('menu.hoteis')}}</dd>
                                            </dl>
                                            <i class="icon soap-icon-hotel"></i>
                                        </div>
                                        <div class="description">
                                            <i class="icon soap-icon-longarrow-right"></i>
                                            <span>{{trans('menu.ver')}} {{trans('menu.hoteis')}}</span>
                                        </div>
                                    </div>
                                </a>
                            </div> -->
                            <div class="col-sm-6 col-md-4">
                                <a href="{{URL::to('passeio')}}">
                                    <div class="fact yellow">
                                        <div class="numbers counters-box">
                                            <dl>
                                                <dt class="display-counter" data-value="{{$passeios}}">0</dt>
                                                <dd>{{trans('menu.passeios')}}</dd>
                                            </dl>
                                            <i class="icon soap-icon-plane"></i>
                                        </div>
                                        <div class="description">
                                            <i class="icon soap-icon-longarrow-right"></i>
                                            <span>{{trans('menu.ver')}} {{trans('menu.passeios')}}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <a href="{{URL::to('translado')}}">
                                    <div class="fact red">
                                        <div class="numbers counters-box">
                                            <dl>
                                                <dt class="display-counter" data-value="{{$translados}}">0</dt>
                                                <dd>{{trans('menu.translado')}}</dd>
                                            </dl>
                                            <i class="icon soap-icon-car"></i>
                                        </div>
                                        <div class="description">
                                            <i class="icon soap-icon-longarrow-right"></i>
                                            <span>{{trans('menu.ver')}} {{trans('menu.translado')}}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <a href="{{URL::to('eventoespecial')}}">
                                    <div class="fact green">
                                        <div class="numbers counters-box">
                                            <dl>
                                                <dt class="display-counter" data-value="{{$especiais}}">0</dt>
                                                <dd>{{trans('menu.eventos_especiais')}}</dd>
                                            </dl>
                                            <i class="icon soap-icon-cruise flip-effect"></i>
                                        </div>
                                        <div class="description">
                                            <i class="icon soap-icon-longarrow-right"></i>
                                            <span>{{trans('menu.ver')}} {{trans('menu.eventos_especiais')}}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="notification-area">
                            <div class="info-box block">
                                <span class="close"></span>
                                <p>{{trans('minhaconta.dashboard')}}</p>
                                <!-- <br />
                                <ul class="circle">
                                    <li><span class="skin-color">Learn How It Works</span> — Watch a short video that shows you how Travelo works.</li>
                                    <li><span class="skin-color">Get Help</span> — View our help section and FAQs to get started on Travelo. </li>
                                </ul> -->
                            </div>
                        </div>
                        
                        <div class="row block">
                            <!-- <div class="col-md-6 notifications">
                                <h2>Notifications</h2>
                                <a href="#">
                                    <div class="icon-box style1 fourty-space">
                                        <i class="soap-icon-plane-right takeoff-effect yellow-bg"></i>
                                        <span class="time pull-right">JUST NOW</span>
                                        <p class="box-title">London to Paris flight in <span class="price">$120</span></p>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="icon-box style1 fourty-space">
                                        <i class="soap-icon-hotel blue-bg"></i>
                                        <span class="time pull-right">10 Mins ago</span>
                                        <p class="box-title">Hilton hotel &amp; resorts in <span class="price">$247</span></p>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="icon-box style1 fourty-space">
                                        <i class="soap-icon-car red-bg"></i>
                                        <span class="time pull-right">39 Mins ago</span>
                                        <p class="box-title">Economy car for 2 days in <span class="price">$39</span></p>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="icon-box style1 fourty-space">
                                        <i class="soap-icon-cruise green-bg"></i>
                                        <span class="time pull-right">1 hour ago</span>
                                        <p class="box-title">Baja Mexico 4 nights in <span class="price">$537</span></p>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="icon-box style1 fourty-space">
                                        <i class="soap-icon-hotel blue-bg"></i>
                                        <span class="time pull-right">2 hours ago</span>
                                        <p class="box-title">Roosevelt hotel in <span class="price">$170</span></p>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="icon-box style1 fourty-space">
                                        <i class="soap-icon-hotel blue-bg"></i>
                                        <span class="time pull-right">3 hours ago</span>
                                        <p class="box-title">Cleopatra Resort in <span class="price">$247</span></p>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="icon-box style1 fourty-space">
                                        <i class="soap-icon-car red-bg"></i>
                                        <span class="time pull-right">3 hours ago</span>
                                        <p class="box-title">Elite Car per day in <span class="price">$48.99</span></p>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="icon-box style1 fourty-space">
                                        <i class="soap-icon-cruise green-bg"></i>
                                        <span class="time pull-right">last night</span>
                                        <p class="box-title">Rome to Africa 1 week in <span class="price">$875</span></p>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="load-more">. . . . . . . . . . . . . </div>
                                </a>
                            </div> -->
                            <div class="col-md-12">
                                <h2>{{trans('minhaconta.latest_offers')}}</h2>
                                <div class="recent-activity">
                                    <ul>
                                        @foreach($produtos as $p)
                                        <li>
                                            <a href="{{URL::to(strtolower($p->class_name) . "/show/$p->id")}}">
                                                <i class="icon soap-icon-plane-right circle takeoff-effect yellow-color"></i>
                                                <span class="price"><small><!-- avg/person --></small>{{$p->valor}}</span>
                                                <h4 class="box-title">
                                                    {{$p->nome_br}}<small>{{$p->tipo}}</small>
                                                </h4>
                                            </a>
                                        </li>
                                        @endforeach
                                        <!-- <li>
                                            <a href="#">
                                                <i class="icon soap-icon-car circle red-color"></i>
                                                <span class="price"><small>per day</small>$45.39</span>
                                                <h4 class="box-title">
                                                    Economy Car<small>bmw mini</small>
                                                </h4>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="icon soap-icon-cruise circle green-color"></i>
                                                <span class="price"><small>from</small>$578</span>
                                                <h4 class="box-title">
                                                    Jacksonville to Asia<small>4 nights</small>
                                                </h4>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="icon soap-icon-hotel circle blue-color"></i>
                                                <span class="price"><small>Avg/night</small>$620</span>
                                                <h4 class="box-title">
                                                    Hilton Hotel &amp; Resorts<small>Paris france</small>
                                                </h4>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="icon soap-icon-hotel circle blue-color"></i>
                                                <span class="price"><small>avg/night</small>$170</span>
                                                <h4 class="box-title">
                                                    Roosevelt Hotel<small>new york</small>
                                                </h4>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="icon soap-icon-plane-right circle takeoff-effect yellow-color"></i>
                                                <span class="price"><small>avg/person</small>$348</span>
                                                <h4 class="box-title">
                                                    Mexico to England<small>return flight</small>
                                                </h4>
                                            </a>
                                        </li> -->
                                    </ul>
                                    <!-- <a href="#" class="button green btn-small full-width">VIEW ALL ACTIVITIES</a> -->
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div id="profile" class="tab-pane fade">
                        <div class="view-profile">
                            <article class="image-box style2 box innerstyle personal-details">
                                <figure>
                                    <a title="" href="#"><img width="270" height="263" alt="" src="http://placehold.it/270x263"></a>
                                </figure>
                                <div class="details">
                                    <!-- <a href="#" class="button btn-mini pull-right edit-profile-btn">{{trans('minhaconta.edit_profile')}}</a> -->
                                    <h2 class="box-title fullname">{{Auth::user()->nome}}</h2>
                                    <dl class="term-description">
                                        <dt>{{trans('minhaconta.user_name')}}</dt><dd>{{Auth::user()->email}}</dd>
                                        <dt>{{trans('minhaconta.phone_number')}}</dt><dd>{{Auth::user()->telefone_celular}}</dd>
                                        <!-- <dt>Date of birth:</dt><dd>15 August 1985</dd>
                                        <dt>Street Address and number:</dt><dd>353 Third floor Avenue</dd>
                                        <dt>Town / City:</dt><dd>Paris,France</dd>
                                        <dt>ZIP code:</dt><dd>75800-875</dd>
                                        <dt>Country:</dt><dd>United States of america</dd> -->
                                    </dl>
                                </div>
                            </article>
                        
                            
                        </div>
                        <div class="edit-profile">
                            <form class="edit-profile-form">
                                <h2>Personal Details</h2>
                                <div class="col-sm-9 no-padding no-float">
                                    <div class="row form-group">
                                        <div class="col-sms-6 col-sm-6">
                                            <label>First Name</label>
                                            <input type="text" class="input-text full-width" placeholder="">
                                        </div>
                                        <div class="col-sms-6 col-sm-6">
                                            <label>Last Name</label>
                                            <input type="text" class="input-text full-width" placeholder="">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sms-6 col-sm-6">
                                            <label>Email Address</label>
                                            <input type="text" class="input-text full-width" placeholder="">
                                        </div>
                                        <div class="col-sms-6 col-sm-6">
                                            <label>Verify Email Address</label>
                                            <input type="text" class="input-text full-width" placeholder="">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sms-6 col-sm-6">
                                            <label>Country Code</label>
                                            <div class="selector">
                                                <select class="full-width">
                                                    <option>United Kingdom (+44)</option>
                                                    <option>United States (+1)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sms-6 col-sm-6">
                                            <label>Phone Number</label>
                                            <input type="text" class="input-text full-width" placeholder="">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-xs-12">Date of Birth</label>
                                        <div class="col-xs-4 col-sm-2">
                                            <div class="selector">
                                                <select class="full-width">
                                                    <option value="">date</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-sm-2">
                                            <div class="selector">
                                                <select class="full-width">
                                                    <option value="">month</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-sm-2">
                                            <div class="selector">
                                                <select class="full-width">
                                                    <option value="">year</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <h2>Contact Details</h2>
                                    <div class="row form-group">
                                        <div class="col-sms-6 col-sm-6">
                                            <label>Street Name</label>
                                            <input type="text" class="input-text full-width">
                                        </div>
                                        <div class="col-sms-6 col-sm-6">
                                            <label>Address</label>
                                            <input type="text" class="input-text full-width">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sms-6 col-sm-6">
                                            <label>City</label>
                                            <div class="selector">
                                                <select class="full-width">
                                                    <option value="">Select...</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sms-6 col-sm-6">
                                            <label>Country</label>
                                            <div class="selector">
                                                <select class="full-width">
                                                    <option value="">Select...</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sms-6 col-sm-6">
                                            <label>Region State</label>
                                            <div class="selector">
                                                <select class="full-width">
                                                    <option value="">Select...</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <h2>Upload Profile Photo</h2>
                                    <div class="row form-group">
                                        <div class="col-sms-12 col-sm-6 no-float">
                                            <div class="fileinput full-width">
                                                <input type="file" class="input-text" data-placeholder="select image/s">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <h2>Describe Yourself</h2>
                                    <div class="form-group">
                                        <textarea rows="5" class="input-text full-width" placeholder="please tell us about you"></textarea>
                                    </div>
                                    <div class="from-group">
                                        <button type="submit" class="btn-medium col-sms-6 col-sm-4">UPDATE SETTINGS</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>                   
                    <div id="travel-stories" class="tab-pane fade">
                        <h2>{{trans('minhaconta.reviews')}}</h2>
                        <div class="col-sm-9 no-float no-padding">
                            <form>
                                <div class="row form-group">
                                    <div class="col-sms-6 col-sm-6">
                                        <label>Story Title</label>
                                        <input type="text" class="input-text full-width">
                                    </div>
                                    <div class="col-sms-6 col-sm-6">
                                        <label>Name</label>
                                        <input type="text" class="input-text full-width">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sms-6 col-sm-6">
                                        <label>Select Miles</label>
                                        <div class="selector full-width">
                                            <select>
                                                <option>4,528 Miles</option>
                                                <option>5,218 Miles</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sms-6 col-sm-6">
                                        <label>Email Address</label>
                                        <input type="text" class="input-text full-width">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sms-6 col-sm-6">
                                        <label>Select Category</label>
                                        <div class="selector full-width">
                                            <select>
                                                <option value="">Adventure, Romance, Beach</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Type Your Story</label>
                                    <textarea rows="6" class="input-text full-width" placeholder="please tell us about you"></textarea>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <h4>Do you have photos to share? <small>(Optional)</small> </h4>
                                    <div class="fileinput col-sm-6 no-float no-padding">
                                        <input type="file" class="input-text" data-placeholder="select image/s" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h4>Share with friends <small>(Optional)</small></h4>
                                    <p>Share your review with your friends on different social media networks.</p>
                                    <ul class="social-icons icon-circle clearfix">
                                        <li class="twitter"><a title="Twitter" href="#" data-toggle="tooltip"><i class="soap-icon-twitter"></i></a></li>
                                        <li class="facebook"><a title="Facebook" href="#" data-toggle="tooltip"><i class="soap-icon-facebook"></i></a></li>
                                        <li class="googleplus"><a title="GooglePlus" href="#" data-toggle="tooltip"><i class="soap-icon-googleplus"></i></a></li>
                                        <li class="pinterest"><a title="Pinterest" href="#" data-toggle="tooltip"><i class="soap-icon-pinterest"></i></a></li>
                                    </ul>
                                </div>
                                <br>
                                <div class="form-group col-sm-5 col-md-4 no-float no-padding no-margin">
                                    <button type="submit" class="btn-medium full-width">SUBMIT REVIEW</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="settings" class="tab-pane fade">
                        <h2>Account Settings</h2>
                        <h5 class="skin-color">Change Your Password</h5>
                        <form action="{{URL::to('cliente/password')}}" method="POST">
                            <div class="row form-group">
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <label>Old Password</label>
                                    <input name="password_old" type="password" class="input-text full-width">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <label>Enter New Password</label>
                                    <input name="password_new" type="password" class="input-text full-width">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <label>Confirm New password</label>
                                    <input name="password_confirm" type="password" class="input-text full-width">
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn-medium">UPDATE PASSWORD</button>
                            </div>
                        </form>                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop