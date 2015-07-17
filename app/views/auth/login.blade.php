@extends('templates.login')
@section('content')
        <section id="content">
            <div class="container">
                <div id="main">
                    <h1 class="logo block">
                        <a href="/" title="{{Config::get('template.title')}}">
                            <img src="images/logo2.png" alt="{{Config::get('template.title')}}" />
                        </a>
                    </h1>
                    <div class="text-center yellow-color box" style="font-size: 4em; font-weight: 300; line-height: 1em;">{{trans('auth.login_welcome')}}</div>
                    <p class="light-blue-color block" style="font-size: 1.3333em;">{{trans('auth.please_login')}} {{trans('auth.ou')}} <a href="URL::to('users/create')" style="color: #fdb714;" >{{trans('auth.please_register')}}</a></p>
                    <div class="col-sm-8 col-md-6 col-lg-5 no-float no-padding center-block">
                        <form class="login-form" role="form" method="POST" action="{{{ URL::to('/users/login') }}}" accept-charset="UTF-8">
                            <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
                            <div class="form-group">
                                <input name="email" type="text" class="input-text input-large full-width" placeholder="{{{ Lang::get('confide::confide.username_e_mail') }}}" value="{{{ Input::old('email') }}}">
                            </div>
                            <div class="form-group">
                                <input name="password" type="password" class="input-text input-large full-width" placeholder="{{{ Lang::get('confide::confide.password') }}}">
                            </div>
                            <div class="form-group">
                                <label class="checkbox">
                                    <input name="remember" type="checkbox" value="1">{{{ Lang::get('confide::confide.login.remember') }}}
                                </label>
                            </div>

                            @if (Session::get('error'))
                                <div class="alert alert-error alert-danger">{{{ Session::get('error') }}}</div>
                            @endif

                            @if (Session::get('notice'))
                                <div class="alert">{{{ Session::get('notice') }}}</div>
                            @endif

                            <button type="submit" class="btn-large full-width sky-blue1">{{{ Lang::get('confide::confide.login.submit') }}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
@stop